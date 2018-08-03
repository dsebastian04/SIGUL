<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UsCuenta;
use app\models\FormLogin;
use app\models\UsLogLogin;
use app\models\OrigenFrecuente;
use app\models\DestinoFrecuente;
use app\models\ConsultaFrecuente;
use app\models\LugarFrecuente;
use common\models\UsLogConsulta;
use yii\data\ArrayDataProvider;
use app\models\ArrayDiv;

/**
 * Site controller
 */
class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'registrar','estadisticasg','estadisticass'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $var = new UsLogLogin();
        $ingresos = $var->find()->select(['CONCAT(us_cuenta.us_nombre," ",us_cuenta.us_apellido) AS  nombre', 'monthname(us_log_login_fecha) as mes', 'dayofmonth(us_log_login_fecha ) as dia', ' time(us_log_login_fecha) as hora '])
                ->from('us_log_login')
                ->join('INNER JOIN', 'us_cuenta', 'us_cuenta.us_cuenta_id=us_log_login.us_cuenta_id')
                ->groupBy('us_log_login_fecha')
                ->orderBy('us_log_login_fecha desc')
                ->limit('5')
                ->asArray()
                ->all(); // query de los ultimos 5 accesos 
        $provider = new ArrayDataProvider([
            'allModels' => $ingresos,
        ]);
        $ultimo = $var->find()->select('us_log_login_fecha as mes')
                ->where(['us_cuenta_id' => Yii::$app->user->identity->us_cuenta_id])
                ->orderBy('mes desc')
                ->limit('2')
                ->asArray()
                ->all(); // 2 ultimos logins del usuario
        $meses=$var->find()->select('monthname(us_log_login_fecha) as mes,'
                . 'count(us_log_login_fecha) as logins ')
                ->groupBy('mes')
                ->orderBy('us_log_login_fecha desc')
                ->limit('5')
                ->asArray()
                ->all();
        $grafica = new ArrayDiv();
        $grafica->dividirArray($meses);
        return $this->render('index', ['log' => ($ultimo), 'dp' => $provider,'grafica'=>$grafica]);
    }

   public function  actionEstadisticasg(){
      
       
       //grafica del origen frecuente
       $arrayOF=OrigenFrecuente::find()->limit('5')->asArray()->all();
       $graficaOF= new ArrayDiv();
       $graficaOF->dividirArray($arrayOF);
       //grafica del destino frecuente
       $arrayDF=  DestinoFrecuente::find()->limit('5')->asArray()->all();
       $graficaDF= new ArrayDiv();
       $graficaDF->dividirArray($arrayDF);
       //grafica del destino frecuente
       $arrayCF= ConsultaFrecuente::find()->limit('5')->asArray()->all();
       $graficaCF= new ArrayDiv();
       $graficaCF->dividirArray($arrayCF);
       //grafica del lugar frecuente
       $arrayLF= LugarFrecuente::find()->limit('5')->asArray()->all();
       $graficaLF= new ArrayDiv();
       $graficaLF->dividirArray($arrayLF);
       
       return $this->render('estadisticasg',['graficaOF'=>$graficaOF,'graficaDF'=>$graficaDF,'graficaCF'=>$graficaCF,'graficaLF'=>$graficaLF]);
   }
   
   public function  actionEstadisticass(){
       
       $consultasdiarias=  UsLogConsulta::find()->select('date(us_log_consulta_fecha) as dia,(count(*)) as consultas_diarias')
               ->where('datediff(current_time,us_log_consulta_fecha)<31')
               ->groupBy('dia')
               ->orderBy('dia desc')
               ->limit('30')
               ->asArray()
               ->all();
       $graficadiaria= new ArrayDiv();
       $graficadiaria->dividirArray(array_reverse($consultasdiarias));
       $consultaMensual=  UsLogConsulta::find()->select('monthname(us_log_consulta_fecha) as mes,(count(*)) as consultas_diarias')
               ->where('datediff(current_time,us_log_consulta_fecha)<360')
               ->groupBy('mes')
               ->orderBy('us_log_consulta_fecha desc')
               ->limit('12')
               ->asArray()
               ->all();
       $graficamensual= new ArrayDiv();
       $graficamensual->dividirArray(array_reverse($consultaMensual));
       $graficamensual->formatear();
       $consultahora=  UsLogConsulta::find()->select('hour(us_log_consulta_fecha) as hora,(count(*)) as consultas_diarias')
               ->where('hour(timediff(now(),us_log_consulta_fecha))<24')
               ->groupBy('hora')
               ->orderBy('us_log_consulta_fecha')
               
               ->asArray()
               ->all();
       $graficahora= new ArrayDiv();
       $graficahora->dividirArray($consultahora);
       return $this->render('estadisticass',['graficaDia'=>$graficadiaria,'graficaMensual'=>$graficamensual,'graficaHora'=>$graficahora]);
   }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new FormLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $log = new UsLogLogin();
            $log->us_cuenta_id = intval($model->username);
            $log->save();
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistrar() {
        $model = new UsCuenta();
        $msg = '';
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                $model->us_estado_usuario = 'activo';
                $ssword = crypt($model->password, \Yii::$app->params["salt"]);
                $model->us_password = $ssword;
                $model->save();
                $msg = '<div class="alert alert-success alert-dismissible" role="alert">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                        . '<span aria-hidden="true">&times;</span></button>Usuario: '
                        . $model->us_cuenta_id . ', ' . $model->us_nombre . ' '
                        . $model->us_apellido . ' creado con éxito!</div>';
            } else {
                $msg = '<div class="alert alert-danger alert-dismissible" role="alert">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                        . '<span aria-hidden="true">&times;</span></button>Surgió un error creando al usuario, intenta de nuevo</div>';
            }
        }
        return $this->render('registrar', ['model' => $model, 'msg' => $msg]);
    }

}

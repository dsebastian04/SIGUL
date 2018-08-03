<?php

namespace frontend\controllers;

use Yii;
use common\models\Busqueda;
use common\models\GeoUbicacion;
use common\models\UsLogConsulta;
use common\models\GeoRelacionUbicacion;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['pedirgeo', 'testeo'],
                        'allow' => true,
                        'roles' => ['?'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        return $this->render('index');
    }

    public function actionTour() {
        return $this->render("tour");
    }

    public function actionBusqueda() {

        $model = new Busqueda();


        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['busqueda-origen']) && isset($_POST['busqueda-destino'])) {
                $model->origen = $_POST['busqueda-origen'];
                $model->destino = $_POST['busqueda-destino'];
            }
        }

        return $this->render("busqueda", ['model' => $model]);
    }

    public function actionTesteo() {

        $var = new GeoRelacionUbicacion();
        $consulta = $var->find()->select('geo_ubicacion_geo_ubicacion_id_1 as id1, geo_ubicacion_geo_ubicacion_id_2 as id2, geo_distancia as dis')->asArray()->all();
        for ($i = 0; $i < count($consulta); $i++) {
            for ($j = 0; $j < count($consulta); $j++) {
                $flag = 0;
                if ($consulta[$i]['id1']==$consulta[$j]['id2'] && $consulta[$i]['id2']==$consulta[$j]['id1']) {
                    $flag = 1;
                    break;
                }
            }
            if($flag==0){
                print_r($consulta[$i]['id2']);
                print_r(' ');
                print_r($consulta[$i]['id1']);
                print_r('<br>');
                
            }
        }
    }

    public function actionPedirgeo() {
        if ($_POST) {
            if (isset($_POST['ruta'])) {
                $ruta = json_decode($_POST['ruta']);

                $consultaLatLong = new GeoUbicacion();
                //falta grabar consulta en BD OJO!!!!
                $consulta = $consultaLatLong->find()->select("geo_ubicacion_id as id,(y(geomfromtext(astext(geo_ubicacion_lat_long)))) as 'lat',(x(geomfromtext(astext(geo_ubicacion_lat_long)))) as 'lng'")
                                ->asArray()
                                ->where(['geo_ubicacion_id' => $ruta])->all();
                $resultado = [];
                $k = 0;
                for ($j = 0; $j < count($ruta); $j++) {
                    for ($i = 0; $i < count($consulta); $i++) {
                        if ($ruta[$j] == doubleval($consulta[$i]['id'])) {
                            $resultado[$k]['lat'] = floatval($consulta[$i]['lat']);
                            $resultado[$k]['lng'] = floatval($consulta[$i]['lng']);
                            $k++;
                            break;
                        }
                    }
                }
                $log = new UsLogConsulta();
                $log->us_log_origen = $ruta[$k - 1];
                $log->us_log_destino = $ruta[0];
                $log->save();
                echo json_encode(array_reverse($resultado));
            }
        }
    }

    public function actionContact() {
        return $this->render('contact');
    }

}

<?php

namespace common\models;

use common\models\GeoUbicacion;
use common\models\GeoRelacionUbicacion;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\web\Cookie;

class Busqueda extends Model {

    public $origen;
    public $destino;

    public function rules() {
        return[
            ['origen', 'required', 'message' => 'Origen requerido'],
            ['destino', 'required', 'message' => 'Destino requerido'],
            ['origen', 'compare', 'compareAttribute' => 'destino', 'operator' => '!==', 'message' => 'El Origen no puede ser igual al Destino']
        ];
    }

    public function listaPuntos() {
        return ArrayHelper::map(GeoUbicacion::find()
                                ->where('geo_tipo_id!=11')
                                
                                ->orderBy('geo_ubicacion_alt, geo_tipo_id,geo_nombre')
                                ->all()
                        , 'geo_ubicacion_id', 'geo_nombre');
    }

    public function setCookie() {


        $grafo = new GeoRelacionUbicacion();
        $array = json_encode($grafo->find()->asArray()->all());
        echo $array;
    }

    function getOrigen() {
        return $this->origen;
    }

    function getDestino() {
        return $this->destino;
    }

    function setOrigen($origen) {
        $this->origen = $origen;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

}

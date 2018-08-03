<?php

namespace app\models;

class ArrayDiv {

    public $etiquetas = [], $valores = [];

    public function dividirArray($array) {

        foreach ($array as $clave => $valor) {
            $i = 1;
            foreach ($valor as $key => $dato) {
                if ($i == 1) {
                    array_push($this->etiquetas, $dato);
                } else {
                    array_push($this->valores, $dato);
                }
                $i++;
            }
        }
    }

    public function formatear() {
        $formatter = \Yii::$app->formatter;
        foreach ($this->valores as $key =>$value){
            $value=$formatter->asDate($value,'long');
        }
    }

}

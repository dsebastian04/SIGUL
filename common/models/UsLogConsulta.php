<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_log_consulta".
 *
 * @property string $us_log_consulta_id
 * @property string $us_log_consulta_fecha
 * @property integer $us_log_origen
 * @property integer $us_log_destino
 *
 * @property GeoUbicacion $usLogOrigen
 * @property GeoUbicacion $usLogDestino
 */
class UsLogConsulta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'us_log_consulta';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('sigul');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['us_log_consulta_fecha'], 'safe'],
            [['us_log_origen', 'us_log_destino'], 'required'],
            [['us_log_origen', 'us_log_destino'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'us_log_consulta_id' => 'Us Log Consulta ID',
            'us_log_consulta_fecha' => 'Us Log Consulta Fecha',
            'us_log_origen' => 'Us Log Origen',
            'us_log_destino' => 'Us Log Destino',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLogOrigen()
    {
        return $this->hasOne(GeoUbicacion::className(), ['geo_ubicacion_id' => 'us_log_origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLogDestino()
    {
        return $this->hasOne(GeoUbicacion::className(), ['geo_ubicacion_id' => 'us_log_destino']);
    }
}

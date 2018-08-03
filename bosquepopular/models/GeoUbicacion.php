<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%geo_ubicacion}}".
 *
 * @property integer $geo_ubicacion_id
 * @property integer $geo_tipo_id
 * @property string $geo_nombre
 * @property string $geo_ubicacion_lat_long
 * @property integer $geo_ubicacion_alt
 *
 * @property GeoRelacionUbicacion[] $geoRelacionUbicacions
 * @property GeoRelacionUbicacion[] $geoRelacionUbicacions0
 * @property GeoUbicacion[] $geoUbicacionGeoUbicacionId2s
 * @property GeoUbicacion[] $geoUbicacionGeoUbicacionId1s
 * @property GeoTipo $geoTipo
 * @property UsLogConsulta[] $usLogConsultas
 * @property UsLogConsulta[] $usLogConsultas0
 */
class GeoUbicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_ubicacion}}';
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
            [['geo_ubicacion_id', 'geo_tipo_id', 'geo_nombre', 'geo_ubicacion_lat_long'], 'required'],
            [['geo_ubicacion_id', 'geo_tipo_id', 'geo_ubicacion_alt'], 'integer'],
            [['geo_ubicacion_lat_long'], 'string'],
            [['geo_nombre'], 'string', 'max' => 45],
            [['geo_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoTipo::className(), 'targetAttribute' => ['geo_tipo_id' => 'geo_tipo_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'geo_ubicacion_id' => 'Geo Ubicacion ID',
            'geo_tipo_id' => 'Geo Tipo ID',
            'geo_nombre' => 'Geo Nombre',
            'geo_ubicacion_lat_long' => 'Geo Ubicacion Lat Long',
            'geo_ubicacion_alt' => 'Geo Ubicacion Alt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoRelacionUbicacions()
    {
        return $this->hasMany(GeoRelacionUbicacion::className(), ['geo_ubicacion_geo_ubicacion_id_1' => 'geo_ubicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoRelacionUbicacions0()
    {
        return $this->hasMany(GeoRelacionUbicacion::className(), ['geo_ubicacion_geo_ubicacion_id_2' => 'geo_ubicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoUbicacionGeoUbicacionId2s()
    {
        return $this->hasMany(GeoUbicacion::className(), ['geo_ubicacion_id' => 'geo_ubicacion_geo_ubicacion_id_2'])->viaTable('{{%geo_relacion_ubicacion}}', ['geo_ubicacion_geo_ubicacion_id_1' => 'geo_ubicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoUbicacionGeoUbicacionId1s()
    {
        return $this->hasMany(GeoUbicacion::className(), ['geo_ubicacion_id' => 'geo_ubicacion_geo_ubicacion_id_1'])->viaTable('{{%geo_relacion_ubicacion}}', ['geo_ubicacion_geo_ubicacion_id_2' => 'geo_ubicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoTipo()
    {
        return $this->hasOne(GeoTipo::className(), ['geo_tipo_id' => 'geo_tipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLogConsultas()
    {
        return $this->hasMany(UsLogConsulta::className(), ['us_log_origen' => 'geo_ubicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLogConsultas0()
    {
        return $this->hasMany(UsLogConsulta::className(), ['us_log_destino' => 'geo_ubicacion_id']);
    }
}

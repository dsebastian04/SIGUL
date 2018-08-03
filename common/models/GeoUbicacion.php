<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "geo_ubicacion".
 *
 * @property integer $geo_ubicacion_id
 * @property integer $geo_bloque_id
 * @property integer $geo_tipo_id
 * @property string $geo_nombre
 * @property string $geo_ubicacion_lat_long
 * @property integer $geo_ubicacion_alt
 *
 * @property GeoOficina $geoOficina
 * @property GeoRelacionUbicacion[] $geoRelacionUbicacions
 * @property GeoRelacionUbicacion[] $geoRelacionUbicacions0
 * @property GeoBloque $geoBloque
 * @property GeoTipo $geoTipo
 */
class GeoUbicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geo_ubicacion';
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
            [['geo_ubicacion_id', 'geo_ubicacion_lat_long'], 'required'],
            [['geo_ubicacion_id', 'geo_bloque_id', 'geo_tipo_id', 'geo_ubicacion_alt'], 'integer'],
            [['geo_ubicacion_lat_long'], 'string'],
            [['geo_nombre'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'geo_ubicacion_id' => 'Geo Ubicacion ID',
            'geo_bloque_id' => 'Geo Bloque ID',
            'geo_tipo_id' => 'Geo Tipo ID',
            'geo_nombre' => 'Geo Nombre',
            'geo_ubicacion_lat_long' => 'Geo Ubicacion Lat Long',
            'geo_ubicacion_alt' => 'Geo Ubicacion Alt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoOficina()
    {
        return $this->hasOne(GeoOficina::className(), ['geo_oficina_id' => 'geo_ubicacion_id']);
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
    public function getGeoBloque()
    {
        return $this->hasOne(GeoBloque::className(), ['geo_bloque_id' => 'geo_bloque_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoTipo()
    {
        return $this->hasOne(GeoTipo::className(), ['geo_tipo_id' => 'geo_tipo_id']);
    }
}

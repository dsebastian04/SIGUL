<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "geo_relacion_ubicacion".
 *
 * @property integer $geo_ubicacion_geo_ubicacion_id_1
 * @property integer $geo_ubicacion_geo_ubicacion_id_2
 * @property integer $geo_distancia
 *
 * @property GeoUbicacion $geoUbicacionGeoUbicacionId1
 * @property GeoUbicacion $geoUbicacionGeoUbicacionId2
 */
class GeoRelacionUbicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geo_relacion_ubicacion';
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
            [['geo_ubicacion_geo_ubicacion_id_1', 'geo_ubicacion_geo_ubicacion_id_2'], 'required'],
            [['geo_ubicacion_geo_ubicacion_id_1', 'geo_ubicacion_geo_ubicacion_id_2', 'geo_distancia'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'geo_ubicacion_geo_ubicacion_id_1' => 'Geo Ubicacion Geo Ubicacion Id 1',
            'geo_ubicacion_geo_ubicacion_id_2' => 'Geo Ubicacion Geo Ubicacion Id 2',
            'geo_distancia' => 'Geo Distancia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoUbicacionGeoUbicacionId1()
    {
        return $this->hasOne(GeoUbicacion::className(), ['geo_ubicacion_id' => 'geo_ubicacion_geo_ubicacion_id_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoUbicacionGeoUbicacionId2()
    {
        return $this->hasOne(GeoUbicacion::className(), ['geo_ubicacion_id' => 'geo_ubicacion_geo_ubicacion_id_2']);
    }
}

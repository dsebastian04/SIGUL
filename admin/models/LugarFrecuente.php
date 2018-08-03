<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lugar_frecuente".
 *
 * @property string $lugar_frecuente
 * @property string $consulta
 */
class LugarFrecuente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lugar_frecuente';
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
            [['consulta'], 'integer'],
            [['lugar_frecuente'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lugar_frecuente' => 'Lugar Frecuente',
            'consulta' => 'Consulta',
        ];
    }
}

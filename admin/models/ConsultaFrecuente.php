<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consulta_frecuente".
 *
 * @property string $ruta
 * @property string $cantidad
 */
class ConsultaFrecuente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consulta_frecuente';
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
            [['cantidad'], 'integer'],
            [['ruta'], 'string', 'max' => 93],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ruta' => 'Ruta',
            'cantidad' => 'Cantidad',
        ];
    }
}

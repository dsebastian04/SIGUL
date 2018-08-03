<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "destino_frecuente".
 *
 * @property string $destino
 * @property string $cantidad
 */
class DestinoFrecuente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'destino_frecuente';
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
            [['destino'], 'required'],
            [['cantidad'], 'integer'],
            [['destino'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'destino' => 'Destino',
            'cantidad' => 'Cantidad',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "origen_frecuente".
 *
 * @property string $origen
 * @property string $cantidad
 */
class OrigenFrecuente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'origen_frecuente';
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
            [['origen'], 'required'],
            [['cantidad'], 'integer'],
            [['origen'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'origen' => 'Origen',
            'cantidad' => 'Cantidad',
        ];
    }
}

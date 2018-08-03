<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "us_log_login".
 *
 * @property string $us_log_login_id
 * @property string $us_cuenta_id
 * @property string $us_log_login_fecha
 *
 * @property UsCuenta $usCuenta
 */
class UsLogLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'us_log_login';
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
            [['us_cuenta_id'], 'required'],
            [['us_cuenta_id'], 'number'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'us_log_login_id' => 'Us Log Login ID',
            'us_cuenta_id' => 'Us Cuenta ID',
            'us_log_login_fecha' => 'Us Log Login Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsCuenta()
    {
        return $this->hasOne(UsCuenta::className(), ['us_cuenta_id' => 'us_cuenta_id']);
    }
}

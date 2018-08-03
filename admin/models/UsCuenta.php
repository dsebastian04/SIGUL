<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "us_cuenta".
 *
 * @property string $us_cuenta_id
 * @property string $us_nombre
 * @property string $us_nombre_medio
 * @property string $us_apellido
 * @property string $us_cuenta_creacion
 * @property string $us_correo
 * @property string $us_estado_usuario
 * @property string $us_password
 *
 * @property UsLogLogin[] $usLogLogins
 */
class UsCuenta extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $password_repeat;
    public $password;

    public static function tableName() {
        return 'us_cuenta';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('sigul');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['us_cuenta_id', 'us_nombre', 'us_apellido', 'us_correo'], 'required'],
            [['us_cuenta_id'], 'number'],
            [['us_nombre', 'us_nombre_medio', 'us_apellido'], 'string', 'max' => 45],
            [['us_correo'], 'string', 'max' => 80],
            [['password'], 'string', 'max' => 20],
            [['password_repeat'], 'string', 'max' => 20],
            [['us_cuenta_id'], 'unique'],
            [['us_cuenta_id'], 'existe_usuario'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'us_cuenta_id' => 'Identificación (Cédula)',
            'us_nombre' => 'Primer Nombre',
            'us_nombre_medio' => 'Segundo Nombre',
            'us_apellido' => 'Apellido',
            'us_cuenta_creacion' => 'fecha de Creación',
            'us_correo' => 'Correo Electrónico',
            'us_estado_usuario' => 'Estado Usuario',
            'password' => 'Password',
            'password_repeat' => 'Repetir Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLogLogins() {
        return $this->hasMany(UsLogLogin::className(), ['us_cuenta_id' => 'us_cuenta_id']);
    }

    public function existe_usuario($attribute, $params) {
        $table = $this->find()->where("us_cuenta_id=:user", [':user' => $this->us_cuenta_id]);
        if ($table->count() == 1) {
            $this->addError($attribute, "El usuario que desea crear ya existe");
        }
    }

}

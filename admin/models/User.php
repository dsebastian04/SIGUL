<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "us_cuenta".
 *
 * @property string $us_cuenta_id
 * @property string $us_nombre
 * @property string $us_nombre_medio
 * @property string $us_apellido_paterno
 * @property string $us_apellido_materno
 * @property integer $us_preguntas_id
 * @property string $us_respuesta_secreta
 * @property integer $us_permitir_ubicacion
 * @property string $us_cuenta_creacion
 * @property integer $us_cedula
 * @property string $us_telefono
 * @property string $us_correo
 * @property integer $us_estado_usuario_id
 * @property integer $us_rol_id
 * @property string $us_password

 * @property string $us_pass_reset_token
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_ACTIVE = 'activo';

    public $rol;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'us_cuenta';
    }

    public static function getDb() {
        return Yii::$app->get('sigul');
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function isUserAdmin($id) {

        if (static::findOne(['us_cuenta_id' => $id,
                    'us_estado_usuario' => self::STATUS_ACTIVE])) {

            return true;
        } else {
            return false;
        }
    }

    public static function isUserSimple($id) {
        if (static::find()
                        ->where(['us_cuenta_id' => $id, 'us_estado_usuario' => self::STATUS_ACTIVE])
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['us_cuenta_id' => $id, 'us_estado_usuario' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['us_cedula' => $username, 'us_estado_usuario' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'us_access_token' => $token,
                    'us_estado_usuario' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        //return $this->us_auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        //   return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return crypt($password, \yii::$app->params['salt']) === $this->us_password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->us_password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        //   $this->us_auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->us_access_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->us_access_token = null;
    }

}

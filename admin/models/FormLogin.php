<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
class FormLogin extends Model {

    public $username;
    public $password;
    public $rememberMe = false;
    public $usuario;

    public function rules() {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'message' => 'Campo requerido'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['username', 'number','message' =>'usuario debe ser numérico'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

     public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o password incorrectos.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->usuario === null) {
            $this->usuario = User::findIdentity($this->username);
        }

        return $this->usuario;
    }
    
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'rememberMe' => 'Recuerdame',  
        ];
    }
    

}


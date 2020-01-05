<?php

namespace common\models;

use yii\base\Model;
use common\models\User;

/**
 * @property string $login
 * @property string $username
 * @property string $password
 * @property string $email
 */
class RegistrationForm extends Model
{
    public $login;
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['login', 'username', 'password', 'email'], 'required'],
            [['login', 'username', 'password'], 'string', 'length' => [8, 30]],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className()]
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            $user = new User();

            $user->login = $this->login;
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->email = $this->email;
            $user->generateAuthKey();

            return $user->save();
        }

        return false;
    }
}
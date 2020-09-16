<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 *
 */
class RegistrationForm extends Model
{
    public $login;
    public $password;
    public $first_name;
    public $last_name;

    private $_user = false;

    public function rules()
    {
        return [
            [['login', 'password', 'first_name', 'last_name'], 'required'],
            [['login', 'password'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 32],

            ['login', 'unique', 'targetClass' => User::class, 'message' => "«{value}» уже существует."]
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }

    public function registrate() {
        if ($this->validate()) {
            $user = new User();
            $user->login = $this->login;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            if ($user->save()) {
                Yii::$app->user->login($user);
                return $user;
            }
        }
        return false;
    }
}

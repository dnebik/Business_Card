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
        $systemArgs = ['login', 'registration', 'settings'];

        $compare = [
            [['login', 'password', 'first_name', 'last_name'], 'required'],

            [['first_name', 'last_name'], 'string', 'max' => 32],

            ['password', 'string', 'max' => 255, 'min' => 6],

            ['login', 'string', 'max' => 25, 'min' => 4],
            ['login', 'match', 'pattern' => '/^([A-Z]|[a-z])+([_-])?([A-Z]|[a-z])*$/', 'message' => '«{attribute}» должен содержать только латинские буквы и разделители \'_-\''],
            ['login', 'unique', 'targetClass' => User::class, 'message' => "«{value}» уже существует."]
        ];

        foreach ($systemArgs as $arg) {
              array_push($compare, [
                  'login',
                  'compare',
                  'compareValue' => $arg,
                  'operator' => '!=',
                  'type' => 'string',
                  'message' => 'значение «{value}» зарезервированно системой.']);
        };

        return $compare;
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

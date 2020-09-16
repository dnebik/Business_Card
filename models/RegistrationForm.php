<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 *
 */
class RegistrationForm extends \yii\db\ActiveRecord
{
    public $login;
    public $password;
    public $first_name;
    public $last_name;

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['login', 'password', 'first_name', 'last_name'], 'required'],
            [['login', 'password'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 32],
//            [['login'], 'unique'],

            ['login', 'unique', 'message' => "«{value}» уже существует."]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }
}

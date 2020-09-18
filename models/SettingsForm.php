<?php


namespace app\models;


use yii\base\Model;

class SettingsForm extends Model
{
    public $email;
    public $phone;
    public $social;
    public $git;

    public function rules()
    {
        return [
            [['phone'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern' => '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/',
                'message' => 'Не верно введён номер телефона.'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'match', 'pattern' => '/.+@.+\..+/i', 'message' => 'Не верно заполненное поле «E-mail».'],
            [['social', 'git'], 'string', 'max' => 255],
            [['social', 'git'], 'match',
                'pattern' => '/^[(http:\/\/)|(https:\/\/)](([a-z0-9\-\.]+)?[a-z0-9\-]+(!?\.[a-z]{2,4}))/',
                'message' => 'Не верно заполненное поле «{attribute}».'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'social' => 'Социальная сеть',
            'git' => 'GitHub',
        ];
    }

}
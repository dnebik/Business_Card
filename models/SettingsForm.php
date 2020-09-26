<?php


namespace app\models;


use yii\base\Model;

class SettingsForm extends Model
{
    public $email;
    public $phone;
    public $social;
    public $git;
    public $career;
    public $languages;
    public $languages_level;
    public $interests;

    public function rules()
    {
        return [
            [['career'], 'string', 'max' => 1000],

            [['phone'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern' => '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/',
                'message' => 'Не верно введён номер телефона.'],

            [['email'], 'string', 'max' => 255],
            [['email'], 'match', 'pattern' => '/.+@.+\..+/i', 'message' => 'Не верно заполненное поле «E-mail».'],

            [['social', 'git'], 'string', 'max' => 255],
            [['social', 'git'], 'match',
                'pattern' => '/[(http:\/\/)|(https:\/\/)].+\..+/',
                'message' => 'Не верно заполненное поле «{attribute}».'],

            [['languages', 'languages_level', 'interests'], 'each', 'rule' => ['string']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'social' => 'Социальная сеть',
            'git' => 'GitHub',
            'languages' => 'Языки',
            'languages_level' => 'Уровень владения языком',
            'interests' => 'Увлечения',
        ];
    }

}
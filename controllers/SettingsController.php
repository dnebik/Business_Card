<?php


namespace app\controllers;

use app\models\Career;
use app\models\LanguageKnowledge;
use app\models\Languages;
use app\models\LevelOfKnowledge;
use app\models\SettingsForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class SettingsController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->getIdentity();
        $model = new SettingsForm();

        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->validate()) {
                error_log(print_r($model, true));

                $user->email = $model->email;
                $user->phone = $model->phone;
                $user->git = $model->git;
                $user->social = $model->social;

                $career = Career::getCareerByUser($user);
                if (!$career) {
                    $career = new Career();
                    $career->id_user = $user->id;
                }
                $career->text = $model->career;

                foreach ($model->languages as $key => $language) {
                    LevelOfKnowledge::addKnowledge($user->id, $language, $model->languages_level[$key] + 1);
                }

                $career->save();
                $user->save();
            }
        }

        return $this->render('index', ['user' => $user, 'model' => $model]);
    }

}
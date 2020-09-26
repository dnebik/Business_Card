<?php


namespace app\controllers;

use app\models\PersonalInterest;
use app\models\PersonalSkills;
use app\models\LanguageKnowledge;
use app\models\Career;
use app\models\Education;
use app\models\Experience;
use app\models\Projects;
use app\models\LevelOfKnowledge;
use app\models\SettingsForm;
use yii\web\Controller;
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

        $skillsData = PersonalSkills::getAllUserSkills($user);
        $languagesData = LanguageKnowledge::getAllUserKnowledge($user);
        $languageLevelData = LevelOfKnowledge::getAllLevels();
        $careerData = Career::getUserCareer($user);
        $educationData = Education::getUserEducation($user);
        $interestsData = PersonalInterest::getUserInterests($user);
        $experiencesData = Experience::getUserExperience($user);
        $projectData = Projects::getUserProjects($user);

        $model = new SettingsForm();

        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->validate()) {

                $user->email = $model->email;
                $user->phone = $model->phone;
                $user->git = $model->git;
                $user->social = $model->social;
                $user->save();

                $careerData = Career::saveCareer($user, $model->career);
                $languagesData = LanguageKnowledge::saveKnowledge($user, $model->languages, $model->languages_level);
                $interestsData = PersonalInterest::saveInterests($user, $model->interests);
            }
        }

        $model->phone = $user->phone;
        $model->email = $user->email;
        $model->social = $user->social;
        $model->git = $user->git;
        $model->languages = $languagesData;
        $model->languages_level = $languageLevelData;
        $model->interests = $interestsData;
        $model->career = $careerData['text'];
//        $model->

        return $this->render('index', compact('model'));
    }

}
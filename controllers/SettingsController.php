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

//              Переделать чтобы все делалось в модели
                $career = Career::getCareerByUser($user);
                if (!$career) {
                    $career = new Career();
                    $career->id_user = $user->id;
                }
//              до сюда

                $career->text = $model->career;

                LanguageKnowledge::deleteAllFromUser($user);
                foreach ($model->languages as $key => $language) {
                    $level = LevelOfKnowledge::getByIdentity($model->languages_level[$key] + 1);
                    LanguageKnowledge::addKnowledge($user, $language, $level);
                }

                $career->save();
                $user->save();
            }
        }

        return $this->render('index', compact(
            'model',
            'user',
            'skillsData',
            'languagesData',
            'languageLevelData',
            'careerData',
            'educationData',
            'interestsData',
            'experiencesData',
            'projectData'
        ));
    }

}
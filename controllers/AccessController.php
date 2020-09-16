<?php


namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use yii\web\Controller;
use app\models\RegistrationForm;
use Yii;

class AccessController extends Controller
{

    public function actionLogin() {
        $model = new LoginForm();

        if ($model->load((Yii::$app->request->post()))) {
            $user = $model->login();
            if ($user) {
                return $this->goHome();
            }
        }

        return $this->render("login", ["model" => $model]);
    }

    public function actionRegistration() {

        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->validate()) {
                $user = $model->registrate();
                if ($user) {
                    return $this->goHome();
                }
            }
        }

        return $this->render("registration", ["model" => $model]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->render("login");
        } else {
            return $this->goHome();
        }
    }
}
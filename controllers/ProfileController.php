<?php


namespace app\controllers;


use app\models\User;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex($login = null)
    {
        $user = User::findByLogin($login);
        if (!$user) {
            return $this->render('nonexistent', ['login' => $login]);
        }
        return $this->render('index', ['user' => $user]);
    }
}
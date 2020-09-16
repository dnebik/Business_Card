<?php


namespace app\controllers;


use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex($login = null)
    {
        error_log("login: " . $login);
        return $this->render('index');
    }
}
<?php


namespace app\controllers;


use app\models\User;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex($user = null)
    {
        $user = User::findByLogin($user);
        return $this->render('index', ['user' => $user]);
    }
}
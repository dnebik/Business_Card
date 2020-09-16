<?php


namespace app\controllers;

use yii\web\Controller;
use app\models\RegistrationForm;
use Yii;

class AccessController extends Controller
{

    public function actionLogin() {
        return $this->render("login");
    }

    public function actionRegistration() {

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post())) {
            error_log(print_r($model, TRUE));
        }
        if ($model->load(Yii::$app->request->post()) && !$model->validate()) {
            $errors = [];
//            foreach ($model->getErrors() as $key => $value) {
//                array_push($errors, [ $key => $value] );
//            }
            return $this->render("registration", ["model" => $model]);
        }

        return $this->render("registration", ["model" => $model]);
    }

}
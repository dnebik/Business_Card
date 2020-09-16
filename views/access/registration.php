<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationForm */
/* @var $form ActiveForm */
/* @var $errors array */

?>
<div class="container accessForm">

    <div class="card accessCard">
        <div class="card-header">Регистрация</div>
        <div class="card-body">

            <?php

            //Устанавливаем опции для полей
            $options = [
                "first_name" => [
                    'options' => ['class' => 'iFName'],
                    'errorOptions' => ['tag' => false],
                ],
                "last_name" => [
                    'options' => ['class' => 'iSName'],
                    'errorOptions' => ['tag' => false],
                ],
                "login" => [
                    'errorOptions' => ['tag' => false],
                ],
                "password" => [
                    'errorOptions' => ['tag' => false],
                ],
            ];

            //убираем отображение ошибки валидации у прошедших валидацию полей
            foreach ($model->getErrors() as $key => $value) {
                if (array_key_exists($key, $options)) {
                    unset($options[$key]['errorOptions']);
                }
            }

            ?>

            <?php $form = ActiveForm::begin(); ?>

            <div class="iName">
                <?= $form->field($model, 'first_name', $options["first_name"])->textInput() ?>
                <?= $form->field($model, 'last_name', $options['last_name'])->textInput() ?>
            </div>
            <?= $form->field($model, 'login', $options['login'])->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password', $options['password'])->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-info']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

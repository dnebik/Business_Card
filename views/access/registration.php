<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationForm */
/* @var $form ActiveForm */
/* @var $errors array */

//error_log(print_r($errors, TRUE));

?>
<div class="container accessForm">
        <?php $form = ActiveForm::begin(); ?>

    <div class="card accessCard">
        <div class="card-header">Регистрация</div>
        <div class="card-body">

            <div class="iName">
                <?= $form->field($model, 'first_name', ['options' => ['class' => 'iFName']])->textInput() ?>
                <?= $form->field($model, 'last_name', ['options' => ['class' => 'iSName']])->textInput() ?>
            </div>
            <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-info']) ?>
            </div>
        </div>
    </div>
        <?php ActiveForm::end(); ?>
</div>

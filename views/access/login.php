<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */

?>

<div class="container accessForm">
    <div class="login">

        <div class="card accessCard">
            <div class="card-header">Вход</div>
            <div class="card-body">


                <?php

                //Устанавливаем опции для полей
                $options = [
                    "login" => [
                        'errorOptions' => ['tag' => false],
                    ],
                    "password" => [
                        'errorOptions' => ['tag' => false],
                    ],
                    "rememberMe" => [
                        'errorOptions' => ['tag' => false],
                        'template' => "{input}{label}</div>\n<div class=\"col-lg-8\">{error}",
                        'options' => ['class' => "custom-control custom-switch", 'style' => 'margin-bottom: 2rem'],
                        'labelOptions' => [
                            'class' => 'custom-control-label',
                            'for' => 'flexSwitchCheckDefault',
                        ],
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

                <?= $form->field($model, 'login', $options['login'])->textInput() ?>
                <?= $form->field($model, 'password', $options['password'])->passwordInput() ?>
                <?= $form->field($model, 'rememberMe', $options['rememberMe'])
                    ->checkbox(["class" => "custom-control-input", "type" => "checkbox", "id" => "flexSwitchCheckDefault"], false)?>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-info']) ?>
                    <a href="<?= Url::to('/access/registration') ?>">
                        <div class="btn btn-success">Зарегистрироваться</div>
                    </a>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div><!-- login -->

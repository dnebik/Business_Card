<?php

use app\models\PersonalInterest;
use app\models\PersonalSkills;
use app\models\LanguageKnowledge;
use app\models\Career;
use app\models\Education;
use app\models\Experience;
use app\models\Projects;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */

$user = Yii::$app->user->getIdentity();

$skillsData = PersonalSkills::getAllUserSkills($user);
$languagesData = LanguageKnowledge::getAllUserKnowledge($user);
$careerData = Career::getUserCareer($user);
$educationData = Education::getUserEducation($user);
$interestsData = PersonalInterest::getUserInterests($user);
$experiencesData = Experience::getUserExperience($user);
$projectData = Projects::getUserProjects($user);

?>

<div class="container settingsForm">
    <div class="card bg-light settingsCard">
        <div class="card-header h2">
            <b>Настройка</b>
        </div>
        <div class="card-body">

            <?php

            //Устанавливаем опции для полей
            $options = [
                "email" => [
                    'errorOptions' => ['tag' => false],
                ],
                "phone" => [
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

            <?= $form->field($model, 'email', $options['email'])->textInput(['value' => $user->email]) ?>
            <?= $form->field($model, 'phone', $options['phone'])->textInput(['value' => $user->phone]) ?>
            <?= $form->field($model, 'social', $options['email'])->textInput(['value' => $user->social]) ?>
            <?= $form->field($model, 'git', $options['email'])->textInput(['value' => $user->git]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info']) ?>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
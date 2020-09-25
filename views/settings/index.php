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
use app\models\LevelOfKnowledge;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */

$user = Yii::$app->user->getIdentity();

$skillsData = PersonalSkills::getAllUserSkills($user);
$languagesData = LanguageKnowledge::getAllUserKnowledge($user);
$languageLevelData = LevelOfKnowledge::getAllLevels();
$careerData = Career::getUserCareer($user);
$educationData = Education::getUserEducation($user);
$interestsData = PersonalInterest::getUserInterests($user);
$experiencesData = Experience::getUserExperience($user);
$projectData = Projects::getUserProjects($user);

error_log(print_r($languageLevelData, true));

$model->career = $careerData['text'];

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
                "career" => [
                    'errorOptions' => ['tag' => false],
                ],
                "languages" => [
                    'errorOptions' => ['tag' => false],
                    'template' => '{input}',
                    'options' => ['class' => 'form-group lang-field'],
                ],
                "languages_level" => [
                    'errorOptions' => ['tag' => false],
                    'template' => '{input}',
                    'options' => ['class' => 'form-group know-field'],
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

            <?= $form->field($model, 'email', $options['email'])->input('email', ['value' => $user->email]) ?>
            <?= $form->field($model, 'phone', $options['phone'])->input('tel',
                ['value' => $user->phone, 'pattern' => "^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$"]) ?>
            <?= $form->field($model, 'social', $options['email'])->textInput(['value' => $user->social]) ?>
            <?= $form->field($model, 'git', $options['email'])->textInput(['value' => $user->git]) ?>
            <?= $form->field($model, 'career', $options['career'])->textarea(['class' => 'textarea', 'hidden' => 'true']) ?>

            <!--     [Языки]      -->

            <? echo Html::label($model->attributeLabels()['languages']); ?>
            <div class="block-inputs">
                <? if (!$languagesData) { ?>
                    <div class="lang-block">
                        <? echo $form->field(
                            $model,
                            'languages[0]',
                            $options['languages'])
                            ->textInput([
                                'class' => 'languages form-control'])
                            ->label(false); ?>
                        <? echo $form->field(
                            $model,
                            'languages_level[0]', $options['languages_level'])
                            ->dropDownList(
                                $languageLevelData, [
                                'class' => 'form-control drop-down-lang',
                                'options' => [
                                    0 => ['selected' => true]]
                            ])->label(false); ?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                <? } else { ?>
                <? foreach ($languagesData as $key => $lang) { ?>
                    <div class="lang-block">
                        <? echo $form->field(
                                $model,
                                'languages[' . $key . ']',
                                $options['languages'])
                                    ->textInput([
                                        'class' => 'languages form-control',
                                        'value' => $lang['language']['name']] )
                                            ->label(false); ?>
                        <? error_log(print_r($lang['level']['id'] - 1, true));
                        echo $form->field(
                                $model,
                                'languages_level[' . $key . ']', $options['languages_level'])
                                    ->dropDownList(
                                        $languageLevelData, [
                                            'class' => 'form-control drop-down-lang',
                                            'options' => [
                                                $lang['level']['id'] - 1 => ['selected' => true]]
                                        ])->label(false); ?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                <? }} ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info']) ?>
            </div>

            <?php ActiveForm::end(); ?>



        </div>
    </div>
</div>
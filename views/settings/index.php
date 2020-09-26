<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SettingsForm */
/* @var $form ActiveForm */

/* @var $user \app\models\User */
/* @var $careerData array */
/* @var $languagesData array */
/* @var $languageLevelData array */
/* @var $interestsData array */

error_log("Languages: " . print_r($model->languages_level, true));


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
                "interests" => [
                    'errorOptions' => ['tag' => false],
                    'template' => '{input}',
                    'options' => ['class' => 'form-group lang-field'],
                ],
                "skill" => [
                    'errorOptions' => ['tag' => false],
                    'template' => '{input}',
                    'options' => ['class' => 'form-group lang-field'],
                ],
                "languages_level" => [
                    'errorOptions' => ['tag' => false],
                    'template' => '{input}',
                    'options' => ['class' => 'form-group know-field'],
                ],
                "skills_percent" => [
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

            <!--     [EMAIL]      -->
            <?= $form->field($model, 'email', $options['email'])->input('email') ?>
            <!--      [PHONE]      -->
            <?= $form->field($model, 'phone', $options['phone'])->input('tel',
                ['pattern' => "^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$"]) ?>
            <!--      [SOCIAL]      -->
            <?= $form->field($model, 'social', $options['email'])->textInput() ?>
            <!--      [GIT]      -->
            <?= $form->field($model, 'git', $options['email'])->textInput() ?>
            <!--      [CAREER]      -->
            <?= $form->field($model, 'career', $options['career'])->textarea([
                'class' => 'textarea',
                'hidden' => 'true'
            ]) ?>

            <!--     [Языки]      -->
            <? echo Html::label($model->attributeLabels()['languages']); ?>
            <div class="block-inputs">
                <?
                $key = 0;
                $lang = $model->languages[$key++];
                do { ?>
                    <div class="lang-block">
                        <?
                        $optionsInput = ['class' => 'form-control'];
                        $optionsInput += ['value' => $lang['language']['name']];
                        $optionsInput += ['maxlength' => 32];
                        echo $form->field($model, 'languages[' . $key . ']', $options['languages'])
                            ->textInput($optionsInput)->label(false);
                        ?>

                        <?
                        $optionsInput = ['class' => 'form-control drop-down-lang'];
                        if ($lang) {
                            $optionsInput += ['options' => [$lang['level']['id'] - 1 => ['selected' => true]]];
                        } else {
                            $optionsInput += ['options' => [0 => ['selected' => true]]];
                        }
                        echo $form->field(
                            $model,
                            'languages_level[' . $key . ']', $options['languages_level'])
                            ->dropDownList(
                                $model->languages_level, $optionsInput)->label(false); ?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus"
                                                                       aria-hidden="true"></i></a>
                    </div>
                <? } while ($lang = $model->languages[$key++]); ?>
            </div>
            <!--     [Языки конец]      -->

            <!--     [Увлечения]      -->
            <? echo Html::label($model->attributeLabels()['interests']); ?>
            <div class="block-inputs">
                <?
                $key = 0;
                $interest = $model->interests[$key++];
                do { ?>
                    <div class="interests-block">
                        <?
                        $optionsInput = ['class' => 'form-control'];
                        $optionsInput += ['value' => $interest['interest']['name']];
                        $optionsInput += ['maxlength' => 32];
                        echo $form->field($model, 'interests[' . $key . ']', $options['interests'])
                            ->textInput($optionsInput)->label(false);
                        ?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus"
                                                                       aria-hidden="true"></i></a>
                    </div>
                <? } while ($interest = $model->interests[$key++]); ?>
            </div>
            <!--     [Увлечения конец]      -->

            <!--     [Навыки]      -->
            <? echo Html::label($model->attributeLabels()['interests']); ?>
            <div class="block-inputs">
                <?
                $key = 0;
                $skill = $model->skills[$key++];
                do { ?>
                    <div class="skills-block">
                        <?
                        $optionsInput = ['class' => 'form-control'];
                        $optionsInput += ['value' => $skill['skill']['name']];
                        $optionsInput += ['maxlength' => 32];
                        echo $form->field($model, 'skills[' . $key . ']', $options['skill'])
                            ->textInput($optionsInput)->label(false);
                        ?>

                        <? echo $form->field($model, 'skills_percent[' . $key . ']', $options['skills_percent'])
                        ->input('number', ['min' => 1, 'max' => 100, 'value' => 1])?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus"
                                                                       aria-hidden="true"></i></a>
                    </div>
                <? } while ($skill = $model->skills[$key++]); ?>
            </div>
            <!--     [Навыки конец]      -->

            <!--      [BUTTON]      -->
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info']) ?>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
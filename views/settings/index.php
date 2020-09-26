<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */

/* @var $user \app\models\User */
/* @var $careerData array */
/* @var $languagesData array */
/* @var $languageLevelData array */
/* @var $interestsData array */

error_log("interests: " . print_r($interestsData, true));

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
                "interests" => [
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

            <!--     [EMAIL]      -->
            <?= $form->field($model, 'email', $options['email'])->input('email', ['value' => $user->email]) ?>
            <!--      [PHONE]      -->
            <?= $form->field($model, 'phone', $options['phone'])->input('tel',
                ['value' => $user->phone, 'pattern' => "^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$"]) ?>
            <!--      [SOCIAL]      -->
            <?= $form->field($model, 'social', $options['email'])->textInput(['value' => $user->social]) ?>
            <!--      [GIT]      -->
            <?= $form->field($model, 'git', $options['email'])->textInput(['value' => $user->git]) ?>
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
                $lang = $languagesData[$key++];
                do { ?>
                    <div class="lang-block">
                        <?
                        $optionsInput = ['class' => 'form-control'];
                        $optionsInput += ['value' => $lang['language']['name']];
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
                                $languageLevelData, $optionsInput)->label(false); ?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus"
                                                                       aria-hidden="true"></i></a>
                    </div>
                <? } while ($lang = $languagesData[$key++]); ?>
            </div>
            <!--     [Языки конец]      -->

            <!--     [Увлечения]      -->
            <? echo Html::label($model->attributeLabels()['interests']); ?>
            <div class="block-inputs">
                <?
                $key = 0;
                $interest = $interestsData[$key++];
                do { ?>
                    <div class="interests-block">
                        <?
                        $optionsInput = ['class' => 'form-control'];
                        $optionsInput += ['value' => $interest['interest']['name']];
                        echo $form->field($model, 'interests[' . $key . ']', $options['interests'])
                            ->textInput($optionsInput)->label(false);
                        ?>

                        <a type="button" class="btn btn-danger del_b"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a type="button" class="btn btn-info add_b"><i class="fa fa-plus"
                                                                       aria-hidden="true"></i></a>
                    </div>
                <? } while ($interest = $interestsData[$key++]); ?>
            </div>
            <!--     [Увлечения конец]      -->

            <!--      [BUTTON]      -->
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info']) ?>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
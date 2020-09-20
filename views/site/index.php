<?php

use yii\helpers\Url;

if (!Yii::$app->user->isGuest) {
    $user = Yii::$app->user->getIdentity();
    header("Location: " . Url::to(['/profile', 'login' => $user['login']]));
    die();
}

?>


<div class="header tHead">
    <img class="tHead-img" src="/img/template/example_card.jpeg">
    <div class="tHead-space"></div>
    <div class="tHead-triangle">
        <div class="tHead-text">
            <b><span>Ваше резюме онлайн</span></b>
            <a href="<?= Url::to('/registration') ?>" class="btn btn-success tHead-button"><span>Создать резюме</span></a>
        </div>
    </div>
</div>
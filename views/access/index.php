<?php

use yii\helpers\Url;

if (Yii::$app->user->isGuest) {
    header("Location: " . Url::to("/access/login"));
} else {
    header("Location: " . Url::to("/profile/" . Yii::$app->user->getIdentity()->getLogin() ));
}

die();
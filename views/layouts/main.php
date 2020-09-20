<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="mWrapper">

    <nav class="navbar">
        <a href="<?=Url::to('/')?>"><span class="navbar-brand">YouCard</span></a>
        <form class="form-inline">
            <?
            if (Yii::$app->user->isGuest) {
                ?>
                <a href="<?= Url::to("/login") ?>">
                    <button class="btn btn-sm btn-info" type="button">Войти</button>
                </a>
            <? } else { ?>
                <a href="<?= Url::to("/access/logout") ?>">
                    <button class="btn btn-sm btn-info" type="button">Выйти</button>
                </a>
            <? } ?>
        </form>
    </nav>

    <div class="content" style="">
        <?= $content ?>
    </div>

    <div class="mFooter">
        <span class="mFooter-captcha">Create with <span style="color: indianred">&hearts;</span> by dneb.</span>
    </div>
</div>
</body>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

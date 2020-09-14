<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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


<!--<header>-->
<!--    <div class="nav" style="background-color: #1b6d85">sad</div>-->
<!--</header>-->

<!-- Javascript -->
<!--    <script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>-->
<!--    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>-->
<!-- custom js -->
<!--    <script type="text/javascript" src="assets/js/main.js"></script>-->


<?= $content ?>

<footer class="footer">
    <div class="text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com"
                                                                                 target="_blank">Xiaoying Riley</a> for
            developers</small>
    </div><!--//container-->
</footer><!--//footer-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

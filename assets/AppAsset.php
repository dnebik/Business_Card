<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/medium-editor/css/medium-editor.css',
        'plugins/medium-editor/css/themes/bootstrap.css',
        'css/styles.css',
        'plugins/font-awesome/css/font-awesome.css',
    ];
    public $js = [
        'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
        'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',
        'plugins/jquery-1.11.3.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/medium-editor/js/medium-editor.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/reset.css',
        'css/magnific-popup.css',
        'css/font-awesome.css',
        'css/slick.css',
        'css/slick-theme.css',
        'css/style.css',
    ];
    public $js = [
        // 'js/jQuery.js',
        'js/jquery.magnific-popup.min.js',
        'js/slick.min.js',
        'http://api-maps.yandex.ru/2.1/?lang=ru_RU',
        'js/jquery.goldcarrot.js',
        'js/java.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

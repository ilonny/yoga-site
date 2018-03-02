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
class FormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/jquery.image-uploader.js',
        'js/jquery.gallery-uploader.js',
        'js/form.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\vendor\TinyMCEAsset',
        'app\assets\vendor\DateTimePickerXdanAsset',
    ];
}

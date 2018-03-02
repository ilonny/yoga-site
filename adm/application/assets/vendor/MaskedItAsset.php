<?php
namespace backend\assets\vendor;

use yii\web\AssetBundle;

class MaskedItAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'vendor/masked-input/jquery.maskedinput.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

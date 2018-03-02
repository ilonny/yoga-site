<?php
namespace app\assets\vendor;

use yii\web\AssetBundle;

class TinyMCEAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        '//cdn.tinymce.com/4/tinymce.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

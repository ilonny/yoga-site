<?php

namespace app\assets;


use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/gallery.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
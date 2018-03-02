<?php
namespace app\assets\vendor;

use yii\web\AssetBundle;

class DateTimePickerXdanAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/datetimepicker-xdan/jquery.datetimepicker.min.css'
    ];
    public $js = [
        'vendor/datetimepicker-xdan/jquery.datetimepicker.full.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

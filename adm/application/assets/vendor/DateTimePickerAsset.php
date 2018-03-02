<?php
namespace app\assets\vendor;

use yii\web\AssetBundle;

class DateTimePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/datetimepicker/css/bootstrap-datetimepicker.min.css'
    ];
    public $js = [
        'vendor/datetimepicker/js/moment.js',
        'vendor/datetimepicker/js/bootstrap-datetimepicker.min.js',
        'vendor/datetimepicker/js/ru.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

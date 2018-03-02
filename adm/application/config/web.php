<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'Администрирование сайта',
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fghDFHFGDFhDFHrtjtry5465eys',
            'csrfParam'=>'admin_csrf',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'appendTimestamp' => true
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl' => ['/user/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'dbFrontEnd' => [
            'class' => 'app\components\DbFrontEnd'
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<action:(\w|-)+>' => '<controller>/<action>',
                '<module:(\w|-)+>/<controller:(\w|-)+>/<action:(\w|-)+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:(\w|-)+>/<controller:(\w|-)+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
            ],
        ],

    ],
    'modules' => [
        'edit' => [
            'class' => 'app\modules\edit\Module',
        ],
        'install' => [
            'class' => 'app\modules\install\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'params' => $params,
];

// if (YII_ENV_DEV) {
//     // configuration adjustments for 'dev' environment
//     $config['bootstrap'][] = 'debug';
//     $config['modules']['debug'] = [
//         'class' => 'yii\debug\Module',
//     ];
//     // configuration adjustments for 'dev' environment
//     $config['bootstrap'][] = 'gii';
//     $config['modules']['gii'] = [
//         'class' => 'yii\gii\Module',
//     ];
// }

return $config;

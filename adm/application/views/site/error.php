<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception \yii\web\HttpException */

use yii\helpers\Html;

$this->title = $name;
$this->context->layout = 'error';
?>
<div class="site-error">
	<a href="/" class="inPage-logo"></a>
	<h2><?= $exception->statusCode; ?></h2>
    <h1><?= Html::encode($message); ?></h1>

    <div class="alert alert-danger">
        
        <a class="bo-back" href="<?= \Yii::$app->homeUrl; ; ?>">Вернуться в админпанель</a>
    </div>
</div>

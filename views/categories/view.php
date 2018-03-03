<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$cat_name = ($category->name) ? $category->name : $category;
$this->title = 'Отзывы о товарах - ' . $cat_name ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
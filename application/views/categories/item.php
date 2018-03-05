<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;
$this->title = 'Отзывы о товаре - ' . $item->name ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <img src="<?= $item->img_src; ?>" alt="">
    <hr>
    <div class="row">
        <h4 class="col-xs-12 col-md-4">Фильтры:</h4>
        <div class="col-xs-12 col-md-8 text-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Сортировать по: <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Рейтингу</a></li>
                    <li><a href="#">Дате</a></li>
                </ul>
            </div>
            <div class="btn-group">            
                <button style="margin-left:10px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Показывать на странице: <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">5</a></li>
                    <li><a href="#">10</a></li>
                    <li><a href="#">15</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="reviews">
            <?php foreach($reviews as $review): ?>
                <div class="col-xs-12 col-md-4">
                    <div class="reviews-block">
                        <div class="reviews-block__title"><?= $review->title; ?> </div>
                        <div class="reviews-block__text"><?= $review->text; ?> </div>
                        <div class="reviews-block__rating">Оценка: <?= $review->rating; ?> из 5 </div>
                        <div style="font-size: 12px;">
                            <a href="">Отзыв полезен (5)</a>
                            <a href="">Отзыв не полезен (2)</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
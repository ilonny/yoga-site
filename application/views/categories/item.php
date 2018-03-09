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
    <hr>
    <?php if (Yii::$app->user->isGuest): ?>
        <h5>Войдите, чтобы оставить отзыв</h5>
    <?php else: ?>
        <form class="reviews-form">
            <h5>Оставить отзыв о товаре - <?= $item->name; ?></h5>
            <input type="hidden" name="item_id" value="<?= $item->id; ?>">
            <div class="form-group">
                <label>Заголовок</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>Текст отзыва</label>
                <textarea type="text" class="form-control" name="text"> </textarea>
            </div>
            <div class="form-group">
                <label>Оценка</label>
                <select name="rating" class="form-control">
                    <?php for ($i=5; $i>=1; $i--): ?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                    <?php endfor;?>
                </select>
            </div>
            <button class="btn btn-default">Отправить</button>
            <div class="help-block"></div>
        </form>
    <?php endif; ?>
    <hr>
</div>
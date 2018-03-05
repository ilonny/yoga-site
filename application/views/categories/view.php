<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;
$cat_name = ($category->name) ? $category->name : $category;
$this->title = 'Отзывы о товарах - ' . $cat_name ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-xs-12 col-md-3">
        <ul class="list-group">
            <h3>Фильтры</h3>
            <div class="list-group-item">
                <h5>Длина</h5>
            </div>
            <?php for ($i=185; $i<=200; $i+=5): ?>
                <div class="list-group-item">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck<?=$i?>">
                        <label class="form-check-label" for="exampleCheck<?=$i?>"><?= $i; ?> см</label>
                    </div>
                </div>
            <?php endfor; ?>
            <div class="list-group-item">
                <h5>Ширина</h5>
            </div>
            <?php for ($i=50; $i<=65; $i+=5): ?>
                <div class="list-group-item">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck<?=$i?>">
                        <label class="form-check-label" for="exampleCheck<?=$i?>"><?= $i; ?> см</label>
                    </div>
                </div>
            <?php endfor; ?>
            <div class="list-group-item">
                <h5>Фирма</h5>
            </div>
            <?php for ($i=50; $i<=65; $i+=5): ?>
                <div class="list-group-item">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck<?=$i?>">
                        <label class="form-check-label" for="exampleCheck<?=$i?>"><?= $i; ?> см</label>
                    </div>
                </div>
            <?php endfor; ?>
        </ul>
    </div>
    <div class="col-xs-12 col-md-9 items">
        <?php foreach ($items as $key => $item): ?>
            <div class="col-xs-12 col-md-4 item-block">
                <div class="img-wrap">
                    <!-- <img src="<?= $item->img_src; ?>"> -->
                    <img src="<?= FileHelper::getImageThumb($item->img_src, 300, 200); ?>">
                </div>
                <div class="item-block__title"><?= $item->name; ?></div>
                <div class="items-block__description"><?= $item->description; ?></div>
                <div class="items-block__rating">Рейтинг: <?= $item->rating; ?> из 5</div>
                <a href="<?= Url::to(['categories/item', 'id' => $item->id]); ?>" class="btn-default btn">Смотреть отзывы</a>          
            </div>
        <?php endforeach; ?>
    </div>
</div>
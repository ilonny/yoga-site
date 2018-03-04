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
    <div class="col-xs-12 col-md-9">
        <?php foreach ($items as $key => $item): ?>
        <?php endforeach; ?>
    </div>
</div>
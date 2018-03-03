<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Категории отзывов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($parent_categories as $key => $p_cat): ?>
        <ul>
            <li>
                <?= $p_cat->name; ?><br>
                <?php 
                    $ch_cats = $p_cat->getChilds();
                    if ($ch_cats){
                        echo '<ul>';
                        foreach ($ch_cats as $c_cat): ?>
                        <li>
                            <a href="<?= Url::to(['categories/view', 'category' => $c_cat['id']]) ?>"><?= $c_cat->name; ?></a>
                        </li>
                    <? echo '</ul>'; endforeach;
                    }
                ?>
            </li>
        </ul>
    <?php endforeach; ?>
</div>

<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\Url;

/** @var array $tables */
/** @var array $oldTables */


$this->title = 'Список таблиц в базе данных';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>
<a href="<?= Url::to(['index']); ?>" class="btn btn-success">Назад</a>

<div class="row">
    <div class="col-lg-6">
        <?= \yii\helpers\Html::beginForm(); ?>
        <?php foreach ($tables as $table): ?>
            <div class="checkbox">
                <?= Html::checkbox('tables[' . $table . ']', in_array($table, $oldTables), ['label' => $table]) ?>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-default">Сохранить</button>
        <?= \yii\helpers\Html::endForm(); ?>
    </div>
</div>



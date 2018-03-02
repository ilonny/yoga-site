<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

/** @var \app\modules\install\models\Table $table */

$this->title = 'Настройка таблицы: ' . $table->name;
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
        <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
        <?= $form->field($table, 'alias')->textInput(); ?>
        <button type="submit" class="btn btn-default">Сохранить</button>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
</div>

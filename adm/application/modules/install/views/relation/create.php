<?php

/* @var $this yii\web\View */
use app\modules\install\models\Relation;
use yii\helpers\Url;

/** @var Relation $relation */
\app\assets\RelationAsset::register($this);
$this->title = 'Связь';
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
    <div class="col-lg-12">
        <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
        <?= $form->field($relation, 'name')->textInput(); ?>
        <?= $form->field($relation, 'source_table_name')->dropDownList(['' => 'Выберите таблицу'] + Relation::getAllTables(), ['class' => 'get-fields form-control', 'data-dependent-selector' => '.source_table_field']); ?>
        <?= $form->field($relation, 'source_table_field')->dropDownList(Relation::getAllFields($relation->source_table_name), ['class' => 'source_table_field form-control']); ?>
        <?= $form->field($relation, 'destination_table_name')->dropDownList(['' => 'Выберите таблицу'] + Relation::getAllTables(), ['class' => 'get-fields form-control', 'data-dependent-selector' => '.destination_table_field']); ?>
        <?= $form->field($relation, 'destination_table_field')->dropDownList(Relation::getAllFields($relation->destination_table_name), ['class' => 'destination_table_field form-control']); ?>
        <?= $form->field($relation, 'destination_table_field_show')->dropDownList(Relation::getAllFields($relation->destination_table_name), ['class' => 'destination_table_field form-control']); ?>

        <button type="submit" class="btn btn-default">Сохранить</button>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</div>




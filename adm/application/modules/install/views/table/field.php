<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/** @var \app\modules\install\models\Table $table */
/** @var \app\modules\install\models\Settings $setting */
/** @var \app\modules\install\models\Field[] $fields */

$this->title = 'Редактируемые поля';
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
        <?php $form = \yii\widgets\ActiveForm::begin([
            'options' => []
        ]); ?>
        <?= $form->field($table, 'alias')->textInput(); ?>
        <?php foreach ($fields as $i => $field): ?>
            <div class="row">
                <div class="col-lg-2">
                    <?= $form->field($field, "[$i]alias")->textInput(); ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($field, "[$i]edit_type_id")->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\install\models\FieldType::find()->all(), 'id', 'alias')); ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($field, "[$i]show_type_id")->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\install\models\FieldShowType::find()->all(), 'id', 'name')); ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($field, "[$i]relation_id")->dropDownList(['' => 'Отсутствует'] + \yii\helpers\ArrayHelper::map(\app\modules\install\models\Relation::find()->all(), 'id', 'name')); ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($field, "[$i]is_editable")->checkbox(); ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($field, "[$i]is_visible_in_list")->checkbox(); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-default">Сохранить</button>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</div>




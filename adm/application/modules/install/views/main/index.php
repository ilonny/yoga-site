<?php

/* @var $this yii\web\View */
/** @var \app\modules\install\models\Settings $setting */

$this->title = 'Основные настройки';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
            <?php if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
                <div class="alert alert-<?= $type ?>">
                    <?= $message ?>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
        <?= $form->field($setting, 'domain')->textInput(); ?>
        <?= $form->field($setting, 'db_driver_name')->dropDownList(['mysql' => 'MySQL', 'pgsql' => 'Postgre SQL']); ?>
        <?= $form->field($setting, 'db_host')->textInput(); ?>
        <?= $form->field($setting, 'db_name')->textInput(); ?>
        <?= $form->field($setting, 'db_username')->textInput(); ?>
        <?= $form->field($setting, 'db_password')->passwordInput(); ?>

        <button type="submit" class="btn btn-default">Сохранить</button>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</div>
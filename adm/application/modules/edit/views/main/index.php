<?php

/* @var $this yii\web\View */
/* @var \app\modules\edit\models\DynamicModel $searchModel */
/* @var \yii\data\ActiveDataProvider $provider */
/* @var \app\models\Settings $settings */
/* @var \app\modules\edit\models\Table $table */
/* @var array $columns */

use app\modules\edit\models\Field;
use yii\widgets\Pjax;

$this->title = $table->alias;
\Yii::$app->user->setReturnUrl(\yii\helpers\Url::current());
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
        <a href="<?= \yii\helpers\Url::to(['create', 'table' => $table->id])?>" class="btn btn-warning">Создать</a>
        <hr>
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
    <div class="col-lg-12">

        <?php Pjax::begin() ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $provider,
                'filterModel' => $searchModel,
                'columns' => Field::getColumns($table, $searchModel),
                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя'
                ],
            ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>
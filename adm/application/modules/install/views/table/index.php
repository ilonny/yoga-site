<?php

/* @var $this yii\web\View */
/** @var \yii\data\ActiveDataProvider $provider */
/** @var \app\modules\install\models\Settings $settings */

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Список таблиц для редактирования';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
        <a href="<?= Url::to(['change-table-list']); ?>" class="btn btn-default">Изменить список таблиц</a>
    </div>
</div>

<div class="row">
        <div class="col-lg-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $provider,
                'columns' => [
                    'name',
                    'alias',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a('Настройка таблицы', ['field', 'table_id' => $data->id], ['class' => 'btn btn-info']);
                        }
                    ]
                ],
                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя'
                ],
            ]) ?>
        </div>
    </div>




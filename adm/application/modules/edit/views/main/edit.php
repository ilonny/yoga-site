<?php

/* @var $this yii\web\View */
/** @var \app\models\Table $table */
/** @var \app\modules\edit\models\DynamicModel $model */
use app\assets\FormAsset;
use yii\helpers\Url;

FormAsset::register($this);

/** @var \app\models\Settings $setting */
/** @var \app\models\Field[] $fields */


$this->title = 'Редактирование';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>
<a href="<?= Url::to(['index', 'id' => $table->id]); ?>" class="btn btn-success">Назад</a>
<br>
<?= $this->render('_form', [
    'model' => $model,
    'fields' => $fields
])?>




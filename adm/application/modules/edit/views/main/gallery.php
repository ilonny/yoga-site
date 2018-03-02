<?php
/** @var \app\models\Table $table */
/** @var \app\models\Field[] $fields */
/** @var \app\modules\edit\models\DynamicModel $model */
/* @var $this yii\web\View */
/** @var \app\modules\edit\models\DynamicModel $model */
/** @var \app\modules\install\models\Gallery $gallery */
use app\assets\FormAsset;
use yii\helpers\Url;

FormAsset::register($this);

$this->title = 'Фотогалерея';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>

<a href="<?= Url::to(['index', 'id' => $table->id]); ?>" class="btn btn-success">Назад</a>
<hr>
<div class="row">
    <div class="col-lg-12">
        <label title="Загрузить новое изображение" for="image-uploader" class="btn btn-md btn-success">
            <input type="file" accept="image/*" multiple="multiple" name="file" id="image-uploader" class="hide gallery-uploader" data-upload-url="<?= Url::to(['/tools/upload-image']) ?>">
            Загрузить изображения
        </label>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <div class="gallery">
            <ul id="images" class="img_block  sortable_images  zoom_images">
                <?php foreach ($gallery->images as $image): ?>
                    <li class="gallery">
                        <input type="hidden" value="<?php echo $image; ?>" name="images[]"/>
                        <img class="imgMain" src="<?php echo Yii::$app->urlManager->hostInfo . $image; ?>"/>
                        <div class="deleteImage" onclick="deleteImage(this); return false;">
                            <img src="/adm/images/delete_button.png" alt="">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear"></div>
        <hr>
        <button type="submit" class="btn btn-default">Сохранить</button>
        <?php $form->end(); ?>
    </div>
</div>
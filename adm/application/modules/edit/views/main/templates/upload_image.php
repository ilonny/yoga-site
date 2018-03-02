<?php

/** @var \yii\widgets\ActiveForm $form */
/** @var \app\models\Field $field */
/** @var string $image_link */
/** @var \yii\web\View $this */
/** @var \app\modules\edit\models\DynamicModel $model */

use yii\helpers\Url;
?>
    <div class="row">
        <div class="col-lg-12">
            <label title="Загрузить новое изображение" for="image-uploader-<?= $field->name?>" class="btn btn-md btn-success">
                <input type="file" accept="image/*" name="file" id="image-uploader-<?= $field->name?>" class="hide image-uploader" data-upload-url="<?= Url::to(['/tools/upload-image']) ?>" data-input="#image-uploader-<?= $field->name?>" data-preview="#image-holder-<?= $field->name;?>" data-link-input="#link-holder-<?= $field->name;?>">
                Загрузить изображение (<?= $field->alias; ?>)
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <img style="max-width:200px; max-height:200px" id="image-holder-<?= $field->name;?>" src="<?php echo \Yii::$app->urlManager->hostInfo . $model->{$field->name}; ?>">
            <?php echo $form->field($model, $field->name)->hiddenInput(['id' => 'link-holder-' . $field->name])->label(false); ?>
        </div>
    </div>



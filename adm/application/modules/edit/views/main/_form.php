<?php
/** @var \app\models\Field[] $fields */
/** @var \app\modules\edit\models\DynamicModel $model */
?>
<div class="row">
    <div class="col-lg-12">
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?php foreach ($fields as $field): ?>
            <div class="form-group">
                <?php switch ($field->type->name) {
                    default:
                    case 'textInput':
//                                echo Html::label($field->alias, 'form-' . $field->name, ['class' => '']);

                        echo $form->field($model, $field->name)->textInput(['class' => 'form-control'])->label($field->alias);
                        break;
                    case 'textArea':
                        echo $form->field($model, $field->name)->textarea(['class' => 'form-control tiny-editor'])->label($field->alias);
                        break;
                    case 'textAreaNoEditor':
                        echo $form->field($model, $field->name)->textarea(['class' => 'form-control', 'rows' => 10])->label($field->alias);
                        break;
                    case 'uploadImage':
                        echo $this->render('templates/upload_image', [
                            'field' => $field,
                            'model' => $model,
                            'form' => $form,
                        ]);
                        break;
                    case 'datetime':
                        echo $form->field($model, $field->name)->textInput(['class' => 'form-control datetimepicker'])->label($field->alias);
                        break;
                    case 'date':
                        echo $form->field($model, $field->name)->textInput(['class' => 'form-control  datepicker'])->label($field->alias);
                        break;
                    case 'time':
                        echo $form->field($model, $field->name)->textInput(['class' => 'form-control  timepicker'])->label($field->alias);
                        break;
                    case 'boolean':
                        echo $form->field($model, $field->name)->dropDownList([0 => 'Нет', 1 => 'Да'], ['class' => 'form-control'])->label($field->alias);
                        break;
                    case 'dropDownList':
                        echo $form->field($model, $field->name)->dropDownList($model->getRelationArray($field->name), ['class' => 'form-control'])->label($field->alias);
                        break;
                } ?>
            </div>
        <?php endforeach; ?>
        <?//php var_dump($model->table) ?>
        <?php if ($model->table->id == 6): ?>
            <label class="input-doc__label">
                <span class="btn btn-success">Загрузить документ</span>
                <span class="message"></span>
                <input type="file" hidden name="input-doc-file" class="input-doc__input" style="display: none !important;">
            </label>
            <br>
        <?php endif; ?>
        <button type="submit" class="btn btn-default submit-form">Сохранить</button>
        <?php $form->end(); ?>
    </div>
</div>
<style>
    input[name="DynamicModel[path]"]{
        cursor: not-allowed;
        background-color: #eee;
        opacity: 1;
        position: relative;
    }
</style>
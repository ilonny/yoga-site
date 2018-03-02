<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inPage">

    <div class="inPage-block lkForm lkLogIn">
        <a href="/adm" class="inPage-logo"></a>
        <div class="inPageF">
            <div class="lkFormTop"><?= Html::encode($this->title) ?></div>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <div class="inPageForm">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="inPageForm">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <?= Html::submitButton('Вход', ['class' => 'btn btn-primary btn-block inPageBtn', 'tabindex' => '3']) ?>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

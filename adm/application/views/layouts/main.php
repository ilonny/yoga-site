<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Table;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl; ?>"><?= Yii::$app->name; ?></a>
        </div>
        <ul class="nav navbar-right top-nav">
            <?php if (\Yii::$app->user->identity->is_admin): ?>
                <li><a href="<?= Url::to(['/install/main/index'])?>">Настройка</a></li>
            <?php endif; ?>
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= Yii::$app->user->identity->username; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['/user/logout'])?>" data-method="post"><i class="fa fa-fw fa-power-off"></i> Выход</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <!--<li class="active">
                    <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>-->
                <?php foreach (Table::find()->where(['name' => \Yii::$app->dbFrontEnd->schema->tableNames])->all() as $table) : ?>
                    <li class="<?= \Yii::$app->controller->action->id == 'index' && \Yii::$app->request->get('id') == $table->id ? 'active' : ''?>">
                        <a href="<?= Url::to(['/edit/main/index', 'id' => $table->id]);?>"><?= $table->alias; ?></a>
                    </li>
                <?php endforeach; ?>
<!--                <li>-->
<!--                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Редактировать <i class="fa fa-fw fa-caret-down"></i></a>-->
<!--                    <ul id="demo" class="collapse">-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>
        </div>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

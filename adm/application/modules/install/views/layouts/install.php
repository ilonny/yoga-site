<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= Yii::$app->user->identity->username; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['/user/logout'])?>" data-method="post"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li <?= \Yii::$app->controller->id == 'main' ? 'class="active"' : ''?>>
                    <a href="<?= \yii\helpers\Url::to(['/install/main/index']); ?>"><i class="fa fa-fw fa-dashboard"></i> Установка</a>
                </li>
                <li <?= \Yii::$app->controller->id == 'table' ? 'class="active"' : ''?>>
                    <a href="<?= \yii\helpers\Url::to(['/install/table/index']); ?>"><i class="fa fa-fw fa-bar-chart-o"></i> Таблицы</a>
                </li>
                <li <?= \Yii::$app->controller->id == 'relation' ? 'class="active"' : ''?>>
                    <a href="<?= \yii\helpers\Url::to(['/install/relation/index']); ?>"><i class="fa fa-fw fa-edit"></i> Связи</a>
                </li>
                <li <?= \Yii::$app->controller->id == 'gallery' ? 'class="active"' : ''?>>
                    <a href="<?= \yii\helpers\Url::to(['/install/gallery/index']); ?>"><i class="fa fa-fw fa-edit"></i> Фотогалереи</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
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

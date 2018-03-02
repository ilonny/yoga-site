<?php

namespace app\modules\install\controllers;

use app\modules\install\models\Table;
use app\modules\install\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use app\modules\install\components\Controller;

class GalleryController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'install';

    /**
     * @return string
     */
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Gallery::find()
        ]);
        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $relation = new Gallery();
        if ($relation->load(\Yii::$app->request->post()) && $relation->insert()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'relation' => $relation
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $relation = Gallery::findOne($id);
        if ($relation->load(\Yii::$app->request->post()) && ($relation->update() !== false)) {
            return $this->redirect(['index']);
        }
        return $this->render('edit', [
            'relation' => $relation
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionDelete($id)
    {
        $relation = Gallery::findOne($id);
        $relation->delete();
        return $this->redirect(['index']);
    }

    /**
     * @param $table
     * @return string
     */
    public function actionGetFields($table)
    {
        return Json::encode(Table::getFields($table));
    }
}

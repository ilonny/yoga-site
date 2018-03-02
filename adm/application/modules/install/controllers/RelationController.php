<?php

namespace app\modules\install\controllers;

use app\modules\install\models\Table;
use app\modules\install\models\Relation;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use app\modules\install\components\Controller;

class RelationController extends Controller
{
    public $layout = 'install';



    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Relation::find()
        ]);
        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    public function actionCreate()
    {
        $relation = new Relation();
        if ($relation->load(\Yii::$app->request->post()) && $relation->insert()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'relation' => $relation
        ]);
    }

    public function actionEdit($id)
    {
        $relation = Relation::findOne($id);
        if ($relation->load(\Yii::$app->request->post()) && ($relation->update() !== false)) {
            return $this->redirect(['index']);
        }
        return $this->render('edit', [
            'relation' => $relation
        ]);
    }

    public function actionDelete($id)
    {
        $relation = Relation::findOne($id);
        $relation->delete();
        return $this->redirect(['index']);
    }

    public function actionGetFields($table)
    {
        return Json::encode(Table::getFields($table));
    }
}

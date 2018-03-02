<?php

namespace app\modules\install\controllers;

use app\modules\install\models\Field;
use app\modules\install\models\Table;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\install\components\Controller;
use yii\web\NotFoundHttpException;

class TableController extends Controller
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
            'query' => Table::find()
        ]);
        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionEdit($id)
    {
        $table = $this->findTable($id);
        if ($table->load(\Yii::$app->request->post()) && $table->validate()) {
            $table->update();
            return $this->redirect(['index']);
        }
        return $this->render('edit', [
            'table' => $table
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\NotSupportedException
     */
    public function actionChangeTableList()
    {
        $tables = \Yii::$app->dbFrontEnd->getSchema()->tableNames;
        $oldTables = Table::find()->select('name')->column();
        if (\Yii::$app->request->isPost && Table::updateTables(\Yii::$app->request->post('tables', []))) {
            return $this->redirect(['index']);
        }
        return $this->render('table_list', [
            'tables' => $tables,
            'oldTables' => $oldTables
        ]);
    }

    /**
     * @param $table_id
     * @return string
     * @throws \Exception
     */
    public function actionField($table_id)
    {
        $fields = Field::getActualFields($this->findTable($table_id));
        $table = $this->findTable($table_id);

        if (Model::loadMultiple($fields, \Yii::$app->request->post()) && Model::validateMultiple($fields)
            && $table->load(\Yii::$app->request->post()) && $table->validate()) {
            $table->update();
            foreach ($fields as $field) {
                $field->update();
            }
            return $this->redirect(['index']);
        }
        return $this->render('field', [
            'fields' => $fields,
            'table' => $table
        ]);
    }

    /**
     * @param $id
     * @return Table
     * @throws NotFoundHttpException
     */
    private function findTable($id)
    {
        $model = Table::findOne($id);
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Таблица не найдена');
    }

}

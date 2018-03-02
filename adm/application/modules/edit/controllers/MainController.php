<?php

namespace app\modules\edit\controllers;

use app\components\Controller;
use app\modules\edit\models\Field;
use app\modules\edit\models\Table;
use app\modules\edit\models\DynamicModel;
use app\modules\edit\models\Gallery;

class MainController extends Controller
{

    public function actionIndex($id)
    {
        /** @var Table $table */
        $table = Table::findOne($id);
        $searchModel = new DynamicModel([], ['table' => $table]);


        $provider = $searchModel->search(\Yii::$app->request->queryParams);
        $list = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$table->name} WHERE id=:id")
            ->bindValues([
                ':id' => $id
            ])->queryAll();
        return $this->render('index', [
            'provider' => $provider,
            'table' => $table,
            'searchModel' => $searchModel,
            'list' => $list,
        ]);
    }

    public function actionEdit($id, $table)
    {
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $tableModel->id, 'is_editable' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($tableModel->name)->columnNames])->all();

        //СОздаем динамическую модель для валидаии данных
        $model = new DynamicModel([], ['table' => $tableModel]);
        $model->loadFromDB($id);
        if ($model->load(\Yii::$app->request->post()) && ($model->update($id) !== false)) {
            \Yii::$app->session->setFlash('success', 'Запись успешно отредактирована');
            return $this->goBack();
        }
        return $this->render('edit', [
            'fields' => $fields,
            'model' => $model,
            'table' => $tableModel
        ]);
    }

    public function actionDelete($id, $table)
    {
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        //СОздаем динамическую модель для валидаии данных
        $model = new DynamicModel([], ['table' => $tableModel]);
        if ($model->delete($id) === false) {
            \Yii::$app->session->setFlash('danger', 'Не удалось удалить запись');
        } else {
            \Yii::$app->session->setFlash('success', 'Запись успешно удалена');
        }
        return $this->goBack();


    }

    public function actionUploadGallery($id, $table, $gallery)
    {
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        /** @var Gallery $galleryModel */
        $galleryModel = Gallery::findOne($gallery);
        $galleryModel->loadImages($id);
        if (\Yii::$app->request->isPost && $galleryModel->saveImages(\Yii::$app->request->post('images', []), $id)) {
            return $this->goBack();
        }
        return $this->render('gallery', [
            'gallery' => $galleryModel,
            'table' => $tableModel
        ]);
    }

    public function actionCreate($table)
    {
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $tableModel->id, 'is_editable' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($tableModel->name)->columnNames])->all();

        $model = new DynamicModel([], ['table' => $tableModel]);

        if ($model->load(\Yii::$app->request->post()) && $model->insert()) {
            \Yii::$app->session->setFlash('success', 'Запись успешно создана');
            return $this->goBack();
        }
        return $this->render('create', [
            'fields' => $fields,
            'model' => $model,
            'table' => $tableModel
        ]);
    }
    

}

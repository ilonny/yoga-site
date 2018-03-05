<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Categories;
use app\models\Items;
use app\models\Reviews;

class CategoriesController extends Controller
{
    /**
     * Displays categories.
     *
     * @return string
     */
    public function actionIndex()
    {
        $parent_categories = Categories::find()->where(['category_parent_id' => null])->all();
        return $this->render('index', [
            'parent_categories' => $parent_categories,
        ]);
    }

    /**
     * Displays Items by category.
     *
     * @return string
     */
    public function actionView($category = null)
    {
        if ($category){
            $category = Categories::findOne($category);
            $items = Items::find()->where(['category_id' => $category->id])->all();
        } else{
            $category = "Все товары";
            $items = Items::find()->all();            
        }
        return $this->render('view', [
            'category' => $category,
            'items' => $items,
        ]);
    }

    /**
     * Displays Items by category.
     *
     * @return string
     */
    public function actionItem($id = null){
        if (!$id){
            throw new \yii\web\NotFoundHttpException();
        }
        $item = Items::findOne($id);
        $reviews = Reviews::find()->where(['item_id' => $id, 'showing' => 1])->all();
        return $this->render('item', [
            'reviews' => $reviews,
            'item' => $item,
        ]);
    }
}

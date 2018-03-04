<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Categories;
use app\models\Items;

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
}

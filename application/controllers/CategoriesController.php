<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\rest\Serializer;
use app\models\Categories;
use app\models\Items;
use app\models\Reviews;

class CategoriesController extends Controller
{

    public $enableCsrfValidation = false;

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


    public function actionSaveReview(){
        $data = Yii::$app->request->get();
        $review = new Reviews;
        $review->title = $data['title'];
        $review->rating = $data['rating'];
        $review->item_id = $data['item_id'];
        $review->user_id = '1';
        $review->showing = 0;
        $review->text = $data['text'];
        if ($review->save()){
            return 'Спасибо, ваш отзыв появится после проверки модераторами';
        } else {
            var_dump($review->getErrors());
            return 'Возникла ошибка. попробуйте позже';
        }
    }
}

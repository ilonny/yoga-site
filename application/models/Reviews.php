<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property double $rating
 * @property int $user_id
 * @property int $item_id
 * @property int $showing
 *
 * @property Users $user
 * @property Items $item
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'rating', 'user_id', 'item_id', 'showing'], 'required'],
            [['text'], 'string'],
            [['rating'], 'number'],
            [['user_id', 'item_id', 'showing'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'rating' => 'Rating',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'showing' => 'Showing',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
}

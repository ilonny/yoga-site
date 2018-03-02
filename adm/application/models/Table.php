<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "table".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название таблицы в базе',
            'alias' => 'Название таблицы в меню',
        ];
    }
}

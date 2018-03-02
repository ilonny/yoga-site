<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_show_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $format
 * @property string $params
 */
class FieldShowType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field_show_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'format', 'params'], 'required'],
            [['params'], 'string'],
            [['name', 'alias', 'format'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'format' => 'Format',
            'params' => 'Params',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relation".
 *
 * @property integer $id
 * @property string $name
 * @property string $source_table_name
 * @property string $source_table_field
 * @property string $destination_table_name
 * @property string $destination_table_field
 * @property string $destination_table_field_show
 */
class Relation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'source_table_name', 'source_table_field', 'destination_table_name', 'destination_table_field', 'destination_table_field_show'], 'required'],
            [['name', 'source_table_name', 'source_table_field', 'destination_table_name', 'destination_table_field', 'destination_table_field_show'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название связи',
            'source_table_name' => 'Исходная таблица',
            'source_table_field' => 'Поле в исходной таблице',
            'destination_table_name' => 'Внешняя таблица',
            'destination_table_field' => 'Поле внешней таблицы',
            'destination_table_field_show' => 'Поле из  внешней таблицы для отображения в списке',
        ];
    }
}

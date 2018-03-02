<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $name
 * @property string $source_table_name
 * @property string $source_table_field
 * @property string $source_table_field_file
 * @property string $destination_table_name
 * @property string $destination_table_field
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'source_table_name', 'source_table_field', 'source_table_field_file', 'destination_table_name', 'destination_table_field'], 'required'],
            [['name', 'source_table_name', 'source_table_field', 'source_table_field_file', 'destination_table_name', 'destination_table_field'], 'string', 'max' => 255],
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
            'source_table_name' => 'Таблица галлереи',
            'source_table_field' => 'Поле в галлереи для внешнего ключа',
            'source_table_field_file' => 'Поле в галлереи для хранения пути',
            'destination_table_name' => 'Внешняя таблица',
            'destination_table_field' => 'Поле во внешней таблицы, для ключа',
        ];
    }
}

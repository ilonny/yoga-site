<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "field".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $table_id
 * @property boolean $is_editable
 * @property boolean $is_visible_in_list
 * @property integer $edit_type_id
 * @property integer $show_type_id
 * @property integer $relation_id
 * @property string $data_type
 * @property string $php_type
 * @property string $db_type
 * @property integer $size
 * @property FieldShowType $showType
 * @property FieldType type
 * @property Table table
 */
class Field extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'table_id', 'data_type', 'php_type', 'db_type'], 'required'],
            [['table_id', 'edit_type_id', 'show_type_id', 'relation_id', 'size'], 'integer'],
            [['is_editable', 'is_visible_in_list'], 'boolean'],
            [['name', 'alias', 'data_type', 'php_type', 'db_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Системное название',
            'alias' => 'Название',
            'is_editable' => 'Разрешить редактирование',
            'is_visible_in_list' => 'Разрешить просмотр в таблице',
            'edit_type_id' => 'Тип редактирования',
            'show_type_id' => 'Тип отображения',
            'relation_id' => 'Связь',
        ];
    }


    /**
     * @return FieldType
     */
    public function getType()
    {
        return $this->hasOne(FieldType::className(), ['id' => 'edit_type_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowType()
    {
        return $this->hasOne(FieldShowType::className(), ['id' => 'show_type_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Table::className(), ['id' => 'table_id']);
    }



}

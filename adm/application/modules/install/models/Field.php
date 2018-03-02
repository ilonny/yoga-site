<?php

namespace app\modules\install\models;

use yii\helpers\ArrayHelper;

/**
 * @inheritdoc
 *
 */
class Field extends \app\models\Field
{


    /**
     * Возвращаем актуальные колонки для базы
     * @param Table $table
     * @return Field[]
     */
    public static function getActualFields(Table $table)
    {
        $columns = \Yii::$app->dbFrontEnd->getTableSchema($table->name)->columnNames;
        //удаляем, отсутствующие в реальной базе, но присутствушщие в системной, колонки
        self::deleteAll(['and', ['not in', 'name', $columns], ['table_id' =>$table->id ]]);

        $fields = self::find()->where(['table_id' => $table->id])->all();
        //добавляем, отсутствующие в системной базе, колонки
        foreach (array_diff($columns, ArrayHelper::map($fields, 'id', 'name')) as $column) {
            self::createField($column, $table->id);
        }
        return self::find()->where(['table_id' => $table->id])->all();
    }

    /**
     * @param $name
     * @param $table_id
     * @return bool
     */
    public static function createField($name, $table_id)
    {
        $model = new self();
        $model->name = $name;
        $model->alias = $name;
        $model->table_id = $table_id;
        return $model->insert();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'table_id'], 'required'],
            [['relation_id'], 'required', 'when' => function($model) {
                return ($model->showType !== null && $model->showType->alias == 'relation') || ($model->type !== null && $model->type->name == 'dropDownList');
            }, 'enableClientValidation' => false],
            [['is_editable', 'is_visible_in_list'], 'boolean'],
            [['edit_type_id', 'table_id', 'relation_id', 'show_type_id'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $column = \Yii::$app->dbFrontEnd->getTableSchema($this->table->name)->getColumn($this->name);
        if ($column === null) {
            $this->delete();
            return false;
        }
        $this->data_type = $column->type;
        $this->db_type = $column->dbType;
        $this->php_type = $column->phpType;
        $this->size = $column->size;
        return parent::beforeSave($insert);
    }
}

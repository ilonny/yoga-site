<?php

namespace app\modules\install\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
class Relation extends \app\models\Relation
{
    /**
     * Получение списка всех таблиц
     *
     * @return array
     */
    public static function getAllTables()
    {
        return array_combine(\Yii::$app->dbFrontEnd->schema->tableNames, \Yii::$app->dbFrontEnd->schema->tableNames);
    }

    /**
     * Получение списка всех полей таблицы $table
     *
     * @param $table
     * @return array
     */
    public static function getAllFields($table)
    {
        $items = [];
        $tableSchema = $table != '' ? \Yii::$app->dbFrontEnd->getTableSchema($table) : null;
        if ($tableSchema !== null) {
            foreach ($tableSchema->columns as $column) {
                $items[$column->name] = $column->name;
            }
        }
        return $items;
    }

    /**
     * Получение значения из связи, по конкретному значению destination_table_field
     *
     * @param $id
     * @return mixed
     */
    public function getValue($id)
    {
        $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `{$this->destination_table_field}`, `{$this->destination_table_field_show}` FROM {$this->destination_table_name} WHERE `{$this->destination_table_field}` = :id ")->bindValues([':id' =>$id])->queryOne();
        return ArrayHelper::getValue($queryResult, $this->destination_table_field_show);
    }

    /**
     * Получение всех значений из связи, по конкретному значению destination_table_field
     *
     * @return mixed
     */
    public function getAllData()
    {
        $queryResult = \Yii::$app->dbFrontEnd
            ->createCommand("SELECT {$this->destination_table_name}.`{$this->destination_table_field}`, {$this->destination_table_name}.`{$this->destination_table_field_show}` 
        FROM {$this->destination_table_name} 
        WHERE {$this->destination_table_name}.{$this->destination_table_field} IN 
          (SELECT {$this->source_table_name}.{$this->source_table_field} FROM {$this->source_table_name} WHERE {$this->source_table_name}.{$this->source_table_field} = {$this->destination_table_name}.{$this->destination_table_field})")
            ->queryAll();
        return ArrayHelper::map($queryResult, $this->destination_table_field, $this->destination_table_field_show);
    }
}

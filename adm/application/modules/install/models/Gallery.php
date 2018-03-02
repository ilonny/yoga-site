<?php

namespace app\modules\install\models;

/**
 * @inheritdoc
 */
class Gallery extends \app\models\Gallery
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

}

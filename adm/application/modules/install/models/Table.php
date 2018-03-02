<?php

namespace app\modules\install\models;

use yii\db\ActiveRecord;

/**
 * @inheritdoc
 */
class Table extends \app\models\Table
{
    /**
     * @param $post
     * @return bool
     */
    public static function updateTables($post)
    {
        $oldTables = Table::find()->select('name')->column();
        $tablesForDelete = array_diff($oldTables, array_keys($post));
        Field::deleteAll(['table_id' => Table::find()->select('id')->where(['name' => $tablesForDelete])->column()]);
        self::deleteAll(['name' => $tablesForDelete]);
        foreach (array_diff(array_keys($post), $oldTables) as $tableName) {
            $model = new self();
            $model->name = $tableName;
            $model->alias = $tableName;
            if ($model->insert()) {
                foreach (\Yii::$app->dbFrontEnd->getTableSchema($tableName)->columns as $column) {
                    Field::createField($column->name, $model->id);
                }
            }
        }
        return true;
    }

    /**
     * @param $table
     * @return array
     */
    public static function getFields($table)
    {
        $columns = \Yii::$app->dbFrontEnd->getTableSchema($table)->columnNames;
        return array_combine($columns, $columns);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getGalleries()
    {
        return Gallery::find()->where(['destination_table_name' => $this->name])->all();
    }
}

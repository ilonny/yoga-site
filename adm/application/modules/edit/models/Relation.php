<?php

namespace app\modules\edit\models;

use yii\helpers\ArrayHelper;


/**
 * @inheritdoc
 */
class Relation extends \app\models\Relation
{

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

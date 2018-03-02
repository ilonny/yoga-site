<?php

namespace app\modules\edit\models;

use yii\db\QueryBuilder;
use yii\helpers\ArrayHelper;

/**
 * @inheritdoc
 */
class Gallery extends \app\models\Gallery
{

    /**
     * @var
     */
    public $images;

    /**
     * Получение значения из связи, по конкретному значению destination_table_field
     *
     * @param $id
     * @return mixed
     */
    public function getValue($id)
    {
        $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `{$this->destination_table_field}` FROM {$this->destination_table_name} WHERE `{$this->destination_table_field}` = :id ")->bindValues([':id' =>$id])->queryOne();
        return ArrayHelper::getValue($queryResult, $this->destination_table_field);
    }

    /**
     * @param $id
     * @return array
     */
    private function getImagesArray($id)
    {
        $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `id`, `{$this->source_table_field_file}` FROM {$this->source_table_name} WHERE `{$this->source_table_field}` = :id ")->bindValues([':id' =>$id])->queryAll();
        return ArrayHelper::map($queryResult, 'id', $this->source_table_field_file);
    }

    /**
     * @param $images
     * @param $id
     * @return bool
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    public function saveImages($images, $id)
    {
        $transaction = \Yii::$app->dbFrontEnd->beginTransaction();
        try {
            $arrayForDelete = array_values(array_diff($this->images, $images));
            if (count($arrayForDelete) > 0) {
                $delCond = [$this->source_table_field => $id, $this->source_table_field_file => $arrayForDelete];
                $query = new QueryBuilder(\Yii::$app->dbFrontEnd);
                $params = [];
                \Yii::$app->dbFrontEnd->createCommand()->delete($this->source_table_name, $query->buildCondition($delCond, $params), $params)->execute();
            }
            $arrayForInsert = array_diff($images, $this->images);
            if (count($arrayForInsert) > 0) {
                array_walk($arrayForInsert, function (&$element) use ($id){
                    $element = [$id, $element];
                });
                \Yii::$app->dbFrontEnd->createCommand()->batchInsert($this->source_table_name, [$this->source_table_field, $this->source_table_field_file ], $arrayForInsert)->execute();
            }
            $transaction->commit();
            $this->loadImages($id);
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @param $id
     */
    public function loadImages($id)
    {
        $this->images = $this->getImagesArray($id);
    }
}

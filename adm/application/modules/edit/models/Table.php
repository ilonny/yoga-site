<?php

namespace app\modules\edit\models;

use yii\db\ActiveRecord;

/**
 * @inheritdoc
 */
class Table extends \app\models\Table
{

    /**
     * @return array|ActiveRecord[]
     */
    public function getGalleries()
    {
        return Gallery::find()->where(['destination_table_name' => $this->name])->all();
    }
}

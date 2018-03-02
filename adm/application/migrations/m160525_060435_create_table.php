<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table`.
 */
class m160525_060435_create_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('table', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('table');
    }
}

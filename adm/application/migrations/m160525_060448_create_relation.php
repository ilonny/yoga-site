<?php

use yii\db\Migration;

/**
 * Handles the creation for table `relation`.
 */
class m160525_060448_create_relation extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('relation', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'source_table_name' => $this->string(255)->notNull(),
            'source_table_field' => $this->string(255)->notNull(),
            'destination_table_name' => $this->string(255)->notNull(),
            'destination_table_field' => $this->string(255)->notNull(),
            'destination_table_field_show' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('relation');
    }
}

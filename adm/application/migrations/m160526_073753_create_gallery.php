<?php

use yii\db\Migration;

/**
 * Handles the creation for table `gallery`.
 */
class m160526_073753_create_gallery extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'source_table_name' => $this->string(255)->notNull(),
            'source_table_field' => $this->string(255)->notNull(),
            'source_table_field_file' => $this->string(255)->notNull(),
            'destination_table_name' => $this->string(255)->notNull(),
            'destination_table_field' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('gallery');
    }
}

<?php

use yii\db\Migration;

class m160516_181959_init extends Migration
{
    public function up()
    {
        $this->createTable('settings', [
            'id' => $this->primaryKey(),
            'is_installed' => $this->boolean()->notNull()->defaultValue(0),
            'domain' => $this->string(255)->notNull(),
            'db_name' => $this->string(255)->notNull(),
            'db_driver_name' => $this->string(255)->notNull(),
            'db_host' => $this->string(255)->notNull(),
            'db_username' => $this->string(255)->notNull(),
            'db_password' => $this->string(255)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('settings');
    }
}

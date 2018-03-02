<?php

use yii\db\Migration;

/**
 * Handles the creation for table `field`.
 */
class m160525_060441_create_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('field', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'table_id' => $this->integer()->notNull(),
            'is_editable' => $this->boolean()->notNull()->defaultValue(0),
            'is_visible_in_list' => $this->boolean()->notNull()->defaultValue(0),
            'edit_type_id' => $this->integer(),
            'show_type_id' => $this->integer(),
            'relation_id' => $this->integer(),
            'data_type' => $this->string(255)->notNull(),
            'php_type' => $this->string(255)->notNull(),
            'db_type' => $this->string(255)->notNull(),
            'size' => $this->integer(),
        ]);

        $this->createTable('field_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
        ]);

        $this->batchInsert('field_type',
            ['name', 'alias'],
            [
                ['textInput', 'Текстовое поле'],
                ['textArea', 'Многострочное текстовое поле с редактором'],
                ['textAreaNoEditor', 'Многострочное текстовое поле без редактора'],
                ['uploadImage', 'Загрузка изображения'],
                ['datetime', 'Дата и время'],
                ['date', 'Дата'],
                ['time', 'Время'],
                ['boolean', 'Да/Нет'],
                ['dropDownList', 'Выбор из списка другой таблицы'],
            ]
        );


        $this->createTable('field_show_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'format' => $this->string(255)->notNull(),
            'params' => $this->text()->notNull()
        ]);

        $this->batchInsert('field_show_type',
            ['name', 'alias', 'format', 'params'],
            [
                ['Заголовок', 'text', 'text', '[]'],
                ['Текст', 'html', 'html', '[]'],
                ['Да/Нет', 'boolean', 'boolean', '[]'],
                ['Изображение', 'image', 'image', '{"style": {"max-width": "120px", "max-height": "120px"}}'],
                ['Дата и время', 'datetime', 'datetime', '[]'],
                ['Дата', 'date', 'date', '[]'],
                ['Время', 'time', 'time', '[]'],
                ['Связь из другой таблицы', 'relation', 'relation', '[]'],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('field');
        $this->dropTable('field_type');
        $this->dropTable('field_show_type');
    }
}

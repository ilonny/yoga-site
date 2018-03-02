<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property boolean $is_installed
 * @property string $domain
 * @property string $db_name
 * @property string $db_driver_name
 * @property string $db_host
 * @property string $db_username
 * @property string $db_password
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_installed'], 'boolean'],
            [['domain', 'db_name', 'db_driver_name', 'db_host', 'db_username', 'db_password'], 'required'],
            [['domain', 'db_name', 'db_driver_name', 'db_host', 'db_username', 'db_password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_installed' => 'Is Installed',
            'domain' => 'Адрес сайта',
            'db_driver_name' => 'Тип БД',
            'db_host' => 'Хост БД',
            'db_name' => 'Название БД',
            'db_username' => 'Имя пользователя БД',
            'db_password' => 'Пароль БД',
        ];
    }
}

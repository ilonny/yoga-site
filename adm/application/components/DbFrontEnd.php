<?php
/**
 * Created by PhpStorm.
 * User: Ямиль
 * Date: 23.05.2016
 * Time: 17:46
 */

namespace app\components;


use app\models\Settings;
use yii\db\Connection;

class DbFrontEnd extends Connection
{
    public $driverName = 'mysql';
    public $host = 'localhost';


    public function open()
    {
        /** @var Settings $frontEndSetting */
        $frontEndSetting = Settings::find()->where(['is_installed' => true])->one();
        $this->dsn = "{$frontEndSetting->db_driver_name}:host={$frontEndSetting->db_host};dbname={$frontEndSetting->db_name}";
        $this->username = $frontEndSetting->db_username;
        $this->password = $frontEndSetting->db_password;
        $this->charset = 'utf8';

        return parent::open();
    }
}
<?php

namespace app\modules\install\models;

/**
 * @inheritdoc
 */
class Settings extends \app\models\Settings
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain', 'db_name', 'db_username', 'db_driver_name', 'db_host'], 'required'],
            [['domain', 'db_name', 'db_username', 'db_password', 'db_driver_name', 'db_host'], 'string', 'max' => 255],
            [['is_installed'], 'integer'],
        ];
    }

    /**
     * @inheritdocZ
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->is_installed = true;
        }
        return parent::beforeSave($insert);
    }

}

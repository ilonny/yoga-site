<?php

namespace app\modules\edit;

/**
 * install module definition class
 */
class Module extends \yii\base\Module
{
    public $defaultRoute = 'main';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\edit\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

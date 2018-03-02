<?php
namespace app\modules\install\components;

use app\modules\install\models\Settings;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class Controller extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->user->loginRequired();
            \Yii::$app->end();
            return parent::beforeAction($action);
        }
        if (!\Yii::$app->user->identity->is_admin) {
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        if (!file_exists(\Yii::getAlias('@app'). '/' . 'config/database.db')) {
            copy(\Yii::getAlias('@app'). '/template_files/database.db', \Yii::getAlias('@app'). '/config/database.db');
        }
        if (!Settings::find()->where(['is_installed' => true])->exists()) {
            return $this->redirect(['/install/main/index']);
        }
        return parent::beforeAction($action);
    }

}
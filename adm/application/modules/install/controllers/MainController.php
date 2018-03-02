<?php

namespace app\modules\install\controllers;

use app\modules\install\models\Settings;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class MainController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'install';

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
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->user->loginRequired();
            \Yii::$app->end();
            return true;
        }
        if (!\Yii::$app->user->identity->is_admin) {
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        if (!file_exists(\Yii::getAlias('@app'). '/' . 'config/database.db')) {
            copy(\Yii::getAlias('@app'). '/template_files/database.db', \Yii::getAlias('@app'). '/config/database.db');
        }
        return parent::beforeAction($action);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $setting = Settings::find()->where(['is_installed' => true])->one();
        if ($setting === null) {
            $setting = new Settings();
            $setting->db_driver_name = 'mysql';
            $setting->db_host = 'localhost';
        }
        if ($setting->load(\Yii::$app->request->post()) && $setting->save()) {
            \Yii::$app->session->setFlash('success', 'Настройки успешно сохранены');
            return $this->refresh();
        }
        return $this->render('index', [
            'setting' => $setting
        ]);
    }
}

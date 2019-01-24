<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    public $layout = 'sidebar';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','laporan'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                            // TODO: Change this
                            return Yii::$app->user->identity->username != 'admin';
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLaporan()
    {
        return $this->render('laporan');
    }
}
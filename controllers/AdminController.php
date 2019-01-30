<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Maganger;
use app\models\Intruksi;
use app\models\Admin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\base\BaseController;

use app\models\Identity;

class AdminController extends BaseController
{
    public $layout = 'sidebar';
    
    public $sidebar = 'admin';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    // Define the authentication check progress here
    public static function authenticate($rule, $action) {
        return Yii::$app->user->identity->_type == Identity::TYPE_ADMIN;
    }

    public function behavior()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'divisi-delete' => ['POST'],
                    'maganger-delete' => ['POST'],
                    'absensi-delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->_render('index', [
            'adminCount' => Admin::find()->count(),
            'magangerCount' => Maganger::find()->count(),
            'intruksiDataset' => Intruksi::find()->orderBy('id_instruksi', SORT_DESC)->all()
        ]);
    }

}
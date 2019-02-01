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
        $cookies_response = Yii::$app->response->cookies;
        $cookies_request = Yii::$app->request->cookies;

        $authentize = $cookies_request->getValue('auth_presensi', false);

        if (Yii::$app->request->get('auth') == 'me') {
            if ($authentize == '11233') {
                $cookies_response->remove('auth_presensi');

                $authentize = false;
            } else {
                $cookies_response->add(new \yii\web\Cookie([
                    'name' => 'auth_presensi',
                    'value' => '11233',
                ]));

                $authentize = '11233';
            }
        }

        return $this->_render('index', [
            'adminCount' => Admin::find()->count(),
            'magangerCount' => Maganger::find()->count(),
            'intruksiDataset' => Intruksi::find()->orderBy('id_instruksi', SORT_DESC)->all(),
            'auth' => $authentize == '11233',
        ]);
    }

}
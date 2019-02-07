<?php

namespace app\controllers;

use Yii;
use app\controllers\base\BaseController;
use yii\filters\AccessControl;
use app\models\Intruksi;
use app\models\Identity;

class UserController extends BaseController
{
    public $layout = 'sidebar';
    public $sidebar = 'user';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
    
    // Define the authentication check progress here
    public static function authenticate($rule, $action)
    {
        return Yii::$app->user->identity->_type == Identity::TYPE_MAGANGER;
    }

    public function behavior()
    {
        return [];
    }

    public function actionIndex()
    {
        return $this->_render('index', [
            'intruksiDataset' => Intruksi::find()->orderBy('id_instruksi', SORT_DESC)->all(),
        ]);
    }

    public function actionLaporan()
    {
        return $this->_render('laporan');
    }
}

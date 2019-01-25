<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\controllers\base\BaseController;

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
    public static function authenticate($rule, $action) {
        return Yii::$app->user->identity->_type == Identity::TYPE_MAGANGER;
    }

    public function behavior()
    {
        return [];
    }

    public function actionIndex()
    {
        return $this->_render('index');
    }

    public function actionLaporan()
    {
        return $this->_render('laporan');
    }
}
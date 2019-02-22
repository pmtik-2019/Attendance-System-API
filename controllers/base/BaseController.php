<?php

namespace app\controllers\base;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

class BaseController extends Controller
{
    public $sidebar_items;
    public $sidebar = 'user';
    
    public $active_view = null;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->sidebar_items = array();

        if (count(explode(':', $this->sidebar)) == 2) {
            list($sidebar, $view) = explode(':', $this->sidebar);

            $this->active_view = $view;
        } else {
            $sidebar = $this->sidebar;
        }

        switch ($sidebar) {
            case 'user':
                $this->addSidebarItem('/user/index', 'index', 'Home', 'home');
                $this->addSidebarItem('/user/laporan', 'laporan', 'Laporan', 'book');
            break;
            case 'admin':
                $this->addSidebarItem('/admin/index', 'index', 'Home', 'home');
                $this->addSidebarItem('/divisi', 'divisi', 'Divisi', 'cog');
                $this->addSidebarItem('/maganger', 'maganger', 'Maganger', 'user');
                // $this->addSidebarItem('/absensi', 'absensi', 'Presensi', 'list-alt');
                $this->addSidebarItem('/laporan', 'laporan', 'Laporan', 'book');
                $this->addSidebarItem('/manager', 'manager', 'Users', 'user');
                $this->addSidebarItem('/intruksi', 'intruksi', 'Instruksi', 'book');
            break;
        }
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function behaviors()
    {
        return $this->_behaviors();
    }

    protected function addSidebarItem($url, $view, $label, $icon)
    {
        array_push($this->sidebar_items, [
            'url' => Url::to($url),
            'view' => $view,
            'label' => $label,
            'icon' => $icon
        ]);
    }

    protected static function setSuccess($messages, $id = 'c_success')
    {
        self::setFlash($messages, $id);
    }

    protected static function setError($messages, $id = 'c_error')
    {
        self::setFlash($messages, $id);
    }

    protected static function setFlash($messages, $id)
    {
        return Yii::$app->session->setFlash($id, $messages);
    }

    protected function _behaviors()
    {
        $rules = [];
        $basic_rules = [
            'allow' => true,
            'roles' => ['@'],
        ];

        $authenticate_callback = $this::className() . '::authenticate';

        $behavior = $this->behavior();
        
        $rules = isset($behavior['rules']) ? array_merge($basic_rules, $behavior['rules']) : $basic_rules;
        if (method_exists($this, 'authenticate')) {
            $rules['matchCallback'] = $authenticate_callback;
        }

        unset($behavior['rules']);

        return array_merge_recursive($behavior, [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $rules,
                ],
            ],
        ]);
    }

    protected function _render($view, $context = [])
    {
        $activev = $this->active_view;

        $this->sidebar_items = array_map(function ($item) use ($view, $activev) {
            if (is_null($activev)) {
                $item['active'] = ($item['view'] == explode('/', $view)[0]);
            } else {
                $item['active'] = ($item['view'] == $activev);
            }

            return $item;
        }, $this->sidebar_items);

        return $this->render($view, $context);
    }
}

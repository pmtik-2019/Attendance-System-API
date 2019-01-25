<?php

namespace app\controllers\base;

use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

class BaseController extends Controller {

    public $sidebar_items;
    public $sidebar = 'user';
    
    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config);

        $this->sidebar_items = array();
        switch ($this->sidebar) {
            case 'user':
                $this->addSidebarItem('/user/index', 'index', 'Home', 'home');
                $this->addSidebarItem('/user/laporan', 'laporan', 'Laporan', 'book');
            break;
            case 'admin':
                $this->addSidebarItem('/admin/index', 'index', 'Home', 'home');
                $this->addSidebarItem('/admin/divisi', 'divisi', 'Divisi', 'cog');
                $this->addSidebarItem('/admin/maganger', 'maganger', 'Maganger', 'user');
                $this->addSidebarItem('/admin/absensi', 'absensi', 'Absensi', 'list-alt');
                $this->addSidebarItem('/admin/laporan', 'laporan', 'Laporan', 'book');
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
        array_push($this->sidebar_items, ['url' => Url::to($url), 'view' => $view, 'label' => $label, 'icon' => $icon]);
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

    protected function _render($view, $context = []) {
        $this->sidebar_items = array_map(function ($item) use($view) {
            $item['active'] = ($item['view'] == $view);

            return $item;
        }, $this->sidebar_items);

        return $this->render($view, $context);
    }
}
<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Divisi;
use app\models\Maganger;
use app\models\DivisiSearch;
use app\models\MagangerSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AdminController extends Controller
{
    public $layout = 'sidebar';
    
    public $sidebar_items;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->sidebar_items = [
            [
                'url' => Url::to(['/admin/index']),
                'view' => 'index',
                'label' => 'Home',
                'icon' => 'home',
            ],
            [
                'url' => Url::to(['/admin/divisi']),
                'view' => 'divisi',
                'label' => 'Divisi',
                'icon' => 'cog',
            ],
            [
                'url' => Url::to(['/admin/maganger']),
                'view' => 'maganger',
                'label' => 'Maganger',
                'icon' => 'user',
            ],
            [
                'url' => Url::to(['/admin/absensi']),
                'view' => 'absensi',
                'label' => 'Absensi',
                'icon' => 'list-alt',
            ],
            [
                'url' => Url::to(['/admin/laporan']),
                'view' => 'laporan',
                'label' => 'Laporan',
                'icon' => 'book',
            ]
        ];
    }

    private function _render($view, $context = []) {
        $this->sidebar_items = array_map(function ($item) use($view) {
            if ($item['view'] == explode('/', $view)[0]) {
                $item['active'] = true;
            }

            return $item;
        }, $this->sidebar_items);

        return $this->render($view, $context);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'divisi-delete' => ['POST'],
                    'maganger-delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                            // TODO: Change this
                            return Yii::$app->user->identity->username == 'admin';
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->_render('index');
    }

    public function actionDivisi()
    {
        $searchModel = new DivisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->_render('divisi/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDivisiCreate()
    {
        $model = new Divisi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['divisi-view', 'id' => $model->kode_divisi]);
        }

        return $this->_render('divisi/create', [
            'model' => $model,
        ]);
    }

    public function actionDivisiView($id)
    {
        return $this->_render('divisi/view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDivisiUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['divisi-view', 'id' => $model->kode_divisi]);
        }

        return $this->_render('divisi/update', [
            'model' => $model,
        ]);
    }

    public function actionDivisiDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['divisi']);
    }

    protected function findModel($id)
    {
        if (($model = Divisi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMaganger()
    {
        $searchModel = new MagangerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->_render('maganger/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMagangerCreate()
    {
        $model = new Maganger();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['maganger-view', 'id' => $model->nim]);
        }

        return $this->_render('maganger/create', [
            'model' => $model,
        ]);
    }

    public function actionMagangerView($id)
    {
        return $this->_render('maganger/view', [
            'model' => $this->findModel1($id),
        ]);
    }

    public function actionMagangerUpdate($id)
    {
        $model = $this->findModel1($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['maganger-view', 'id' => $model->nim]);
        }

        return $this->_render('maganger/update', [
            'model' => $model,
        ]);
    }

    public function actionMagangerDelete($id)
    {
        $this->findModel1($id)->delete();

        return $this->redirect(['maganger']);
    }

    protected function findModel1($id)
    {
        if (($model = Maganger::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
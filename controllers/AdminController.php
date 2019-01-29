<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Divisi;
use app\models\Maganger;
use app\models\Admin;
use app\models\DivisiSearch;
use app\models\MagangerSearch;
use app\models\Absensi;
use app\models\AbsensiSearch;
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
        ]);
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

    //Absensii
    public function actionAbsensi()
    {
        $searchModel = new AbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->_render('absensi/index', [
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

    public function actionAbsensiCreate()
    {
        $model = new Absensi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['absensi-view', 'id' => $model->id_absensi]);
        }

        return $this->_render('absensi/create', [
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

    public function actionAbsensiView($id)
    {
        return $this->_render('absensi/view', [
            'model' => $this->findModelAbsensi($id),
        ]);
    }

    public function actionAbsensiUpdate($id)
    {
        $model = $this->findModelAbsensi($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['absensi-view', 'id' => $model->id_absensi]);
        }

        return $this->_render('absensi/update', [
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

    public function actionAbsensiDelete($id)
    {
        $this->findModelAbsensi($id)->delete();

        return $this->redirect(['absensi']);
    }

    protected function findModelAbsensi($id)
    {
        if (($model = Absensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionLaporan()
    {
        $searchModel = new AbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->_render('laporan/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
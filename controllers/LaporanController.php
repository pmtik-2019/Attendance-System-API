<?php

namespace app\controllers;

use Yii;
use app\controllers\base\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Absensi;
use app\models\AbsensiSearch;
use app\models\Identity;
use kartik\mpdf\Pdf;

/**
 * ManagerController implements the CRUD actions for Admin model.
 */
class LaporanController extends BaseController
{
    public $layout = 'sidebar';
    public $sidebar = 'admin:laporan';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    // Define the authentication check progress here
    public static function authenticate($rule, $action)
    {
        return Yii::$app->user->identity->_type == Identity::TYPE_ADMIN;
    }

    public function behavior()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $connection = Yii::$app->getDb();
        $model = new Absensi();
        
        $dateRange = Yii::$app->request->get('Absensi');
        $exportPdf = Yii::$app->request->get('export');
        $dataProvider = NULL;

        if (!empty($dateRange['tanggal_waktu'])) {

            list($date_start, $date_end) = explode(' - ', $dateRange['tanggal_waktu']);

            $dataProvider = $connection->createCommand("SELECT * FROM absensi WHERE date(tanggal_waktu) >= :date_start AND date(tanggal_waktu) <= :date_end", [':date_start' => $date_start, ':date_end' => $date_end])->queryAll();
            if ($dataProvider == null) $dataProvider = false;

            if (!empty($exportPdf) && $exportPdf == true) {

                // echo $this->renderPartial('report', [
                //     'dataProvider' => $dataProvider,
                // ]); exit;

                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'format' => Pdf::FORMAT_A4,
                    'orientation' => Pdf::ORIENT_PORTRAIT,
                    'destination' => Pdf::DEST_BROWSER,
                    'content' => $this->renderPartial('report', [
                        'dataProvider' => $dataProvider,
                    ]),
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                    'cssInline' => 'kv-heading-1{font-size:18px} .content{ font-family: \'Times New Roman\',Times, serif}',
                    'options' => ['title' => 'Laporan Presensi Maganger'],
                    'methods' => [
                        'SetHeader' => ['Laporan Presensi Maganger'],
                        'SetFooter' => ['{PAGENO}'],
                        ]
                ]);
                
                return $pdf->render();
            }
        }

        return $this->_render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'dateRange' => $dateRange,            
            'absensiCount' => !empty($dataProvider) ? count($dataProvider) : 0,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->_render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Absensi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_absensi]);
        }

        return $this->_render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_absensi]);
        }

        return $this->_render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Absensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

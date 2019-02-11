<?php

namespace app\controllers;

use app\controllers\base\BaseController;
use app\models\Absensi;
use app\models\Identity;
use app\models\Intruksi;
use kartik\mpdf\Pdf;
use Yii;

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
        $connection = Yii::$app->getDb();
        $model = new Absensi();
        
        $dateRange = Yii::$app->request->get('Absensi');
        $dataProvider = NULL;

        if (!empty($dateRange['tanggal_waktu'])) {

            list($date_start, $date_end) = explode(' - ', $dateRange['tanggal_waktu']);

            $dataProvider = $connection->createCommand("SELECT * FROM absensi WHERE nim = :nim AND date(tanggal_waktu) >= :date_start AND date(tanggal_waktu) <= :date_end", [':nim' => Yii::$app->user->identity->username, ':date_start' => $date_start, ':date_end' => $date_end])->queryAll();
            if ($dataProvider == null) $dataProvider = false;

        }

        return $this->_render('laporan', [
            'dataProvider' => $dataProvider,
            'model' => $model,            
            'absensiCount' => !empty($dataProvider) ? count($dataProvider) : 0,
        ]);
    }

    public function actionPdfreport(){
        $content=$this->renderPartial('report');

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content, 
            'cssFile' =>'@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => 'kv-heading-1{font-size:18px}', 
            'options' => ['title' =>'Laporan Presensi Maganger', 
            'methods' => [
                'SetHeader' =>['Laporan Presensi Maganger'], 
                'SetFooter' =>['{PAGENO}'],
            ]
        ]]);
        return $pdf->render(); 
    }
}

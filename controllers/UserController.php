<?php

namespace app\controllers;

use app\controllers\base\BaseController;
use app\models\Absensi;
use app\models\Identity;
use app\models\Intruksi;
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
}

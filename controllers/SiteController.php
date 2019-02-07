<?php

namespace app\controllers;

use Yii;
use app\controllers\base\BaseController;
use yii\filters\VerbFilter;
use app\models\Identity;
use app\models\Maganger;
use app\models\LoginForm;
use app\models\Absensi;

class SiteController extends BaseController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function behavior()
    {
        return [
            'access' => [
                'only' => ['logout']
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function goDashboard()
    {
        return (Yii::$app->user->identity->_type == Identity::TYPE_ADMIN) ? $this->redirect(['admin/index']) : $this->redirect(['user/index']);
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goDashboard();
        }

        $cookies = Yii::$app->request->cookies;

        $authentize = $cookies->getValue('auth_presensi', false);

        if ($authentize !== false && $authentize == '11233') {
            $absensi = new Absensi();

            $custom_post_model = Yii::$app->request->post();

            $custom_post_model['Absensi']['tanggal_waktu'] = date("Y-m-d H:i:s");
            if (empty($custom_post_model['Absensi']['laporan_kerja'])) {
                $custom_post_model['Absensi']['laporan_kerja'] = null;
            }

            if ($absensi->load($custom_post_model) && $absensi->validate()) {
                // Check last absence first
                $postDataAbsensi = (object) $custom_post_model['Absensi'];
                
                $getLastAbsensi = Absensi::find()->where([
                    'nim' => $postDataAbsensi->nim,
                ])->andWhere('date(tanggal_waktu) = DATE(NOW())')->orderBy(['id_absensi' => SORT_DESC])->limit(1)->one();
                
                $isSafeToSave = true;
                // jika pernah absen hari ini
                if (!is_null($getLastAbsensi)) {
                    // Harus berbeda dengan absen sebelumnya
                    if ($getLastAbsensi->status_kedatangan == $postDataAbsensi->status_kedatangan) {
                        // tolak! karena misalkan pulang-pulang atau datang-datang
                        $isSafeToSave = 'Anda tidak bisa melakukan presensi sama seperti sebelumnya!';
                    }
                } else {
                    // Harus datang dulu
                    if ($postDataAbsensi->status_kedatangan == 2) {
                        // tolak! karena belum datang masa sudah pulang
                        $isSafeToSave = 'Anda belum presensi kedatangan!';
                    }
                }

                if ($isSafeToSave === true && $absensi->save()) {
                    self::setSuccess('Presensi berhasil ditambahkan!');
                } else {
                    self::setError($isSafeToSave);
                }
            }
        }

        return $this->render('index', [
            'model' => Maganger::find()->where(['status_maganger' => 1])->all(),
            'auth' => $authentize,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goDashboard();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goDashboard();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

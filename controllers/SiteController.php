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
                $dontSaveRequest = false;

                if (is_null($getLastAbsensi)) {
                    if ($postDataAbsensi->status_kedatangan == 2) {
                        // tolak! karena belum datang masa sudah pulang
                        $isSafeToSave = 'Anda belum presensi kedatangan!';
                    }
                } else {
                    if (!is_null($getLastAbsensi) && $postDataAbsensi->status_kedatangan == 1) {
                        $isSafeToSave = 'Anda tidak harus persensi kedatangan lagi!';
                    } else {
                        if (explode(' ', $getLastAbsensi->tanggal_waktu)[1] != '16:00:00') {
                            $isSafeToSave = 'Anda sudah presensi pulang, buat apa pulang lagi? Besok lagi aja!';
                        } else {
                            # Update the last presensi
                            $getLastAbsensi->tanggal_waktu = date("Y-m-d H:i:s");
                            $getLastAbsensi->save();

                            $dontSaveRequest = true;
                        }
                    }
                }

                if ($isSafeToSave === true) {
                    if ($dontSaveRequest === false) {
                        $absensi->save();

                        if (is_null($getLastAbsensi)) {
                            $absensi_pulang = new Absensi();
                            $postDataAbsensi_copy = $custom_post_model;

                            $postDataAbsensi_copy['Absensi']['tanggal_waktu'] = date("Y-m-d") . " 16:00:00";
                            $postDataAbsensi_copy['Absensi']['status_kedatangan'] = 2;

                            $absensi_pulang->load($postDataAbsensi_copy);
                            $absensi_pulang->save();
                        }
                    }

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

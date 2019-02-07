<?php

namespace app\controllers;

use Yii;
use app\controllers\base\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Identity;
use app\models\Maganger;
use app\models\MagangerSearch;

class MagangerController extends BaseController
{
    public $layout = 'sidebar';
    public $sidebar = 'admin:maganger';

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
        $searchModel = new MagangerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $model = new Maganger();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nim]);
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
            return $this->redirect(['view', 'id' => $model->nim]);
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
        if (($model = Maganger::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

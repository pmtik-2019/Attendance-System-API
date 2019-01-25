<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AbsensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Absensis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="absensi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Absensi', ['absensi-create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_absensi',
            'status_kedatangan',
            'tanggal_waktu',
            'laporan_kerja:ntext',
            'nim',

            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view} {update} {delete}',
            //     'buttons' => [
            //         'view' => function($url, $model) {
            //         return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['absensi-view', 'id' => $model['id_absensi']], ['title' => 'View', 'id' => 'modal-btn-view']);
            //         },
            //         'update' => function($id, $model) {
            //             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['absensi-update', 'id' => $model['id_absensi']], ['title' => 'Update', 'id' => 'modal-btn-view']);
            //         },
            //         'delete' => function($url, $model) {
            //             return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['absensi-delete', 'id' => $model['id_absensi']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
            //         }
            //     ]
            // ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

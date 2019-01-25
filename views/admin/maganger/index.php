<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MagangerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maganger';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maganger-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data Maganger', ['maganger-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nim',
            'nama_maganger',
            'kodeDivisi.nama_divisi',
            'status_maganger',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['maganger-view', 'id' => $model['nim']], ['title' => 'View', 'id' => 'modal-btn-view']);
                    },
                    'update' => function($id, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['maganger-update', 'id' => $model['nim']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                    },
                    'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['maganger-delete', 'id' => $model['nim']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DivisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Divisi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="divisi-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Membuat Divisi', ['divisi-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_divisi',
            'nama_divisi',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['divisi-view', 'id' => $model['kode_divisi']], ['title' => 'View', 'id' => 'modal-btn-view']);
                    },
                    'update' => function($id, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['divisi-update', 'id' => $model['kode_divisi']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                    },
                    'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['divisi-delete', 'id' => $model['kode_divisi']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

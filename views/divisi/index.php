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
        <?= Html::a('Tambah Data Divisi', ['create'], ['class' => 'btn btn-success']) ?>
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
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

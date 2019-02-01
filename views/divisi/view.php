<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Divisi */

$this->title = 'Informasi divisi: ' . $model->kode_divisi;
$this->params['breadcrumbs'][] = ['label' => 'Divisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="divisi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="fa fa-edit"></span> Edit', ['update', 'id' => $model->kode_divisi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="fa fa-trash"></span> Hapus', ['divisi', 'id' => $model->kode_divisi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ada Yakin Akan Menghapus?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_divisi',
            'nama_divisi',
        ],
    ]) ?>

</div>

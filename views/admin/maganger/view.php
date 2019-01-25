<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Maganger */

$this->title = $model->nim;
$this->params['breadcrumbs'][] = ['label' => 'Maganger', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="maganger-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['maganger-update', 'id' => $model->nim], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['maganger-delete', 'id' => $model->nim], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nim',
            'nama_maganger',
            'kode_divisi',
            [
                'attribute' => 'nama_divisi',
                'value' => $model->kodeDivisi->nama_divisi
            ],
            [
                'attribute' => 'password_maganger',
                'value' => str_repeat('*', strlen($model->password_maganger))
            ],
            [
                'attribute' => 'status_maganger',
                'value' => function () use($model) {
                    return ($model->status_maganger == 1) ? 'Aktif' : 'Non Aktif';
                }
            ],
        ],
    ]) ?>

</div>

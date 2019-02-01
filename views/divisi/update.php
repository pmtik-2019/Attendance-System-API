<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Divisi */

$this->title = 'Update Divisi: ' . $model->kode_divisi;
$this->params['breadcrumbs'][] = ['label' => 'Divisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_divisi, 'url' => ['view', 'id' => $model->kode_divisi]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="divisi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

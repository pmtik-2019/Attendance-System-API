<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Divisi */

$this->title = 'Membuat Divisi Baru';
$this->params['breadcrumbs'][] = ['label' => 'Divisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="divisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Intruksi */

$this->title = 'Tambah Data Instruksi';
$this->params['breadcrumbs'][] = ['label' => 'Instruksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intruksi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

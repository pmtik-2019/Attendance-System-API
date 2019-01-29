<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Intruksi */

$this->title = 'Update Intruksi: ' . $model->id_instruksi;
$this->params['breadcrumbs'][] = ['label' => 'Intruksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_instruksi, 'url' => ['view', 'id' => $model->id_instruksi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intruksi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

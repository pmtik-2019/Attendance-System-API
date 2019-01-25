<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Maganger */

$this->title = 'Update Maganger: ' . $model->nim;
$this->params['breadcrumbs'][] = ['label' => 'Magangers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nim, 'url' => ['view', 'id' => $model->nim]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maganger-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

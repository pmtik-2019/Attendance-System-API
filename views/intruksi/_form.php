<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Intruksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intruksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judul')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gambar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Divisi; 

/* @var $this yii\web\View */
/* @var $model app\models\Maganger */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maganger-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_maganger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_divisi')->dropDownList(ArrayHelper::map(Divisi::find()->all(), 'kode_divisi', 'nama_divisi'), array('promp' => 'Pilih Divisi')) ?>

    <?= $form->field($model, 'password_maganger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_maganger')->dropDownList(
        ['0' => 'Non Aktif', '1' => 'Aktif']
    ) ?>

     <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

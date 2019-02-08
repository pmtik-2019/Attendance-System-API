<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="absensi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Masukkan range tanggal presensi yang akan diambil laporannya.</p>
    <form action="" class="form-inline">
        <?php
        $form = ActiveForm::begin();
        echo $form->field($model, 'tanggal_waktu', [
            'addon' => ['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
            'options' => ['class'=>'drp-container form-group',],
            'showLabels' => false,
        ])->widget(DateRangePicker::classname(), [
            'useWithAddon'=>true
        ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Lihat Laporan', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </form>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <!-- <p>
        <?= Html::a('Tambah Data Laporan', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?php
    if ($dataProvider !== null) {
        var_dump($dataProvider);
    }
    ?>
    <?php Pjax::end(); ?>
</div>

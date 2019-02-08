<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;

?>
<script>
    var availableTags = [<?php array_map(function ($obj) {
    echo "{value: '{$obj->nim}', label: '{$obj->nim} - {$obj->nama_maganger}'}, ";
}, $model); ?>];
</script>
<div class="site-index">
        <?php if ($auth): ?>
        <div class="jumbotron">
            <h1>Selamat Datang!</h1>

            <p class="lead">Silahkan melakukan presensi dengan mengisi form dibawah ini.</p>
        </div>

        <div class="body-content">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Presensi Online</div>
                    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal form-absensi']]); ?>

                    <div class="panel-body">
                    <?php if (Yii::$app->session->hasFlash('c_success')): ?>
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Tersimpan!</h4>
                            <?= Yii::$app->session->getFlash('c_success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (Yii::$app->session->hasFlash('c_error')): ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Kesalahan!</h4>
                            <?= Yii::$app->session->getFlash('c_error') ?>
                        </div>
                    <?php endif; ?>
                        <p>Masukkan data anda pada kolom yang telah disediakan, untuk bagian tanggal dan waktu tidak dapat diubah secara manual oleh anda. Sistem akan menggunakan waktu <i>server</i>.</p>
                            
                        
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="Absensi[status_kedatangan]" id="tipe_berangkat" value="1" checked> Berangkat
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="Absensi[status_kedatangan]" id="tipe_pulang" value="2"> Pulang
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="Absensi[nim]">NIM</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="nim" name="Absensi[nim]">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="date">Tanggal</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="date" class="form-control" id="date" readonly>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="time">Waktu</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon2"><i class="glyphicon glyphicon-time"></i></span>
                                        <input type="text" class="form-control" id="time" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="laporan" style="display: none;">
                                <label class="col-lg-2 control-label" for="laporan_kerja">Laporan</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="Absensi[laporan_kerja]" id="laporan_kerja" rows="3"></textarea>
                                    <p class="help-block">Terkhusus untuk pulang, silahkan masukkan laporan kerja anda pada kolom yang telah disediakan.</p>
                                </div>
                            </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-bookmark"></i> Present!</button>
                    </div>
                    <?php $form = ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="body-content">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img width="800px;" src="https://cdn.dribbble.com/users/34790/screenshots/1638786/uh_oh.png" alt="Sorry">
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
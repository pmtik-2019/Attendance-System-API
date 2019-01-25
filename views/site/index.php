<?php

/* @var $this yii\web\View */

?>
<div class="site-index">

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
                    <div class="panel-body">
                        <p>Masukkan data anda pada kolom yang telah disediakan, untuk bagian tanggal dan waktu tidak dapat diubah secara manual oleh anda. Sistem akan menggunakan waktu <i>server</i>.</p>
                        <form action="" class="form-horizontal form-absensi">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="tipe" id="tipe1" value="1" checked> Berangkat
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="tipe" id="tipe2" value="2"> Pulang
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="nim">NIM</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="nim">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="nim">Tanggal</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="date" class="form-control" id="nim" readonly>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="nim">Waktu</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon2"><i class="glyphicon glyphicon-time"></i></span>
                                        <input type="text" class="form-control" id="nim" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="laporan" style="display: none;">
                                <label class="col-lg-2 control-label" for="nim">Laporan</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="3"></textarea>
                                    <p class="help-block">Terkhusus untuk pulang, silahkan masukkan laporan kerja anda pada kolom yang telah disediakan.</p>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <a href="#" class="btn btn-primary"><i class="glyphicon glyphicon-bookmark"></i> Present!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
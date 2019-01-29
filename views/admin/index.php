<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
        	 <div class="col-lg-6">
			     <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                       'type' => \insolita\wgadminlte\LteConst::COLOR_ORANGE,
                       'title' => $adminCount,
                       'text' => 'Admin',
                       'icon' => 'fa fa-cloud-download',
                       'footer' => 'Lihat Semuanya ',
                       'link' => '#'
                   ]);?>
        	 </div>
            <div class="col-lg-6">
           <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                       'type' => \insolita\wgadminlte\LteConst::COLOR_BLUE,
                       'title' => $magangerCount,
                       'text' => 'Maganger',
                       'icon' => 'fa fa-cloud-download',
                       'footer' => 'Lihat Semuanya ',
                       'link' => '#'
                   ]);?>
           </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <h3>Instruksi Menggunakan Aplikasi Sistem Informasi Presensi Maganger</h3>
                <br/>
                1. Gunakan NIM Anda untuk LOGIN <br/>
                2. Pilih Button "Masuk" atau "Keluar" <br/>
                3. Melihat jumlah admin dan maganger di menu "Home" <br/>
                4. Menambahkan divisi atau melihat data divisi melalui menu "Divisi" <br/>
            </div>
        </div>

    </div>
</div>

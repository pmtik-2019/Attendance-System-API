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
            <div class="col-lg-12">
                <?php if ($auth): ?>
                <p>Dengan menekan tombol di bawah, komputer ini akan dihapus dari pembuatan presensi!</p>
                <a href="?auth=me" class="btn btn-danger">Hapus Authentikasi!</a>
                <?php else: ?>
                <p>Dengan menekan tombol di bawah, komputer ini akan bisa untuk dibuat presensi!</p>
                <a href="?auth=me" class="btn btn-primary">Authentikasi Me!</a>
                <?php endif; ?>
                <br>
                <br>
            </div>
            <div class="col-lg-8">
                <?php
                if (empty($intruksiDataset)) {
                    echo '<p>Tidak ada intruksi ditemukan!</p>';
                } else {
                    foreach ($intruksiDataset as $intruksi) {
                        echo '<h3>'.$intruksi->judul.'</h3><br />';
                        echo str_replace("\n", "<br />", $intruksi->deskripsi);
                    }
                }
                ?>
            </div>
        </div>

    </div>
</div>

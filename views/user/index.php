<?php

/* @var $this yii\web\View */
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
  
  <div class="row">
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


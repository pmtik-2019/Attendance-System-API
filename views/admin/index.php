<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
        	 <div class="col-lg-6">
			 <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                       'type' => \insolita\wgadminlte\LteConst::COLOR_BLUE,
                       'title' => '90%',
                       'text' => 'Free Space',
                       'icon' => 'fa fa-cloud-download',
                       'footer' => 'Lihat Semuanya ',
                       'link' => '#'
                   ]);?>
        	 </div>
        </div>

    </div>
</div>

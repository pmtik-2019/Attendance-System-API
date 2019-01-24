<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
        	 <div class="col-lg-6">
        	 	 <?php \insolita\wgadminlte\LteBox::begin([
		             'type'=>\insolita\wgadminlte\LteConst::TYPE_INFO,
		             'isSolid'=>true,
		             'boxTools'=>'<button class="btn btn-success btn-xs create_button" ><i class="fa fa-plus-circle"></i> Add</button>',
		             'tooltip'=>'this tooltip description',
		             'title'=>'Manage users',
		             'footer'=>'total 44 active users',
		         ])?>
		        ANY BOX CONTENT HERE
		    <?php \insolita\wgadminlte\LteBox::end()?>
        	 </div>
        </div>

    </div>
</div>

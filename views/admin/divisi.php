<?php
use yii\helpers\Html;
?>
 <td><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-cog"></i> Primary</button></td>
<form class="form-horizontal" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="id_divisi">ID Divisi:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="id_divisi" placeholder="Enter divisi">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="nama_divisi">Nama Divisi:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" id="nama_divisi" placeholder="Enter Nama Divisi">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
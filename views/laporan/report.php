<?php

$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--header-->
<content>
  <table class="header">
    <tr>
      <td style="text-align:left; width:10%"></td>
      <td style="text-align:center; width:80%"> UPT TIK UNS <br>LAPORAN PRESENSI MAGANGER</td>
      <td style="text-align:right; width:10%"><?=date('d/m/Y');?></td>
    </tr>
  </table>
<hr/>
<div class="absensi-index"> 
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Tanggal / Waktu</th>
                  <th>Laporan Kerja</th>
                  <th>Status Kedatangan</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($dataProvider as $tb_1): ?>
                    <tr>
                    <th><?=$tb_1['id_absensi']?></th>
                    <th><?=$tb_1['nim']?></th>
                    <th><?=$tb_1['tanggal_waktu']?></th>
                    <th><?=$tb_1['laporan_kerja'] == NULL ?  '-' : $tb_1['laporan_kerja']?></th>
                    <th><?=$tb_1['status_kedatangan'] == 1 ?'Berangkat' : 'Pulang'?></th>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
    </div>
    <?php
         

    ?>
    </content>
</div>


<?php

$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--header-->
<content>
  <table>
    <tr>
      <td><img src="../web/img/uns.png" width=15%></td>
      <td style="width: 75%;">
        <center>
          <b> KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI <br/> 
          UNIVERSITAS SEBELAS MARET <br/>
          UPT. TEKNOLOGI INFORMASI DAN KOMUNIKASI <br/>
          Sekretariat : Jalan Ir. Sutami No. 36 A Kentingan Surakarta Telp.(0271) 638959 </b> 
        </center>
      </td>
      <td style="text-align: right; width: 10%"></td>
     
    </tr>
  </table>
<hr/>
 <center><b>LAPORAN PRESENSI MAGANGER</b></center>
<div class="absensi-index">
        </td>
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
                <?php foreach($dataProvider as $index => $tb_1): ?>
                    <tr>
                    <th><?=($index + 1)?></th>
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


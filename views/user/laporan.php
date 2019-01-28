<?php

/* @var $this yii\web\View */
$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-laporan">
              <h1>Laporan Presensi Magang</h1>

            <div class="form-inline pull-right">
              <label>Search:         
              <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"
              ></label>
</div>
                <div class="form-inline pull-left">
                <label>Show
                <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select> entries</label>
            </div>
            
    </div>
              <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Hari/Tanggal</th>
                  <th>Jam Datang</th>
                  <th>Jam Pulang</th>
                  <th>Laporan</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Selasa, 18 November 2018</td>
                  <td>08.00
                  </td>
                  <td>16.00</td>
                  <td> Jaga FO</td>
                  <td><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-cog"></i> Primary</button>
                  <button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-cog"></i> Warning</button></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Selasa, 18 November 2018</td>
                  <td>07.51
                  </td>
                  <td>16.00</td>
                  <td>Mengerjakan Buku Album</td>
                  <td><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-cog"></i> Primary</button>
                  <button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-cog"></i> Warning</button></td>
                </tr>
                <tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <ul class="pagination pagination-sm pull-right">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>
</div>

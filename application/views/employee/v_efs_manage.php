<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    
  <hr />

  <?= $this->session->flashdata('message'); ?>

  <div class="row" style="zoom:80%">
    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Arsip Masuk</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file-alt fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php foreach($tahun as $th) { ?>
      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Arsip Masuk Tahun <?= $th['tahun']; ?></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $th['num']; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Tables</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered table-striped display select cell-border" id="efs_table" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>ID Link</th>
              <th>No Berkas</th>
              <th>Keterangan</th>
              <th>Lokasi</th>
              <th>No Bantek</th>
              <th>Nama Arsip</th>
              <th>Tanggal Arsip</th>
              <th>Divisi Pengarsip</th>
              <th>Download</th>
              <th>Edit</th>
              <?php if($this->session->userdata('role_id') == 1) {  ?>
                <th>Delete</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr align="center">
              <th>ID Link</th>
              <th>No Berkas</th>
              <th>Keterangan</th>
              <th>Lokasi</th>
              <th>No Bantek</th>
              <th>Nama Arsip</th>
              <th>Tanggal Arsip</th>
              <th>Divisi Pengarsip</th>
              <th>Download</th>
              <th>Edit</th>
              <?php if($this->session->userdata('role_id') == 1) {  ?>
                <th>Delete</th>
              <?php } ?>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->
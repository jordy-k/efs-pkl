<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a href="#title"><h1 id="title" class="h3 mb-4 text-gray-800"><?= $title;?></h1></a>
  <hr />
  <?= $this->session->flashdata('message');?>
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
  
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-line"></i> Grafik EFS</h6>
        </div>
        <div class="card-body">
          <canvas id="chart_efs"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie"></i> Grafik Arsip Masuk per Divisi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie">
            <canvas id="arsip_divisi"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
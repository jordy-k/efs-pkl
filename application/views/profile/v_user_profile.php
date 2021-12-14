<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <div class="row">
      <div class="col-lg">
        <?= $this->session->flashdata('message');?>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Arsip Masuk oleh Divisi <?= $profile['divisi']; ?></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_divisi; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Arsip Masuk oleh <?= $profile['name']; ?></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_user; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <!-- Card -->
        <div class="card shadow mb-3 border-left-primary">
          <!-- Card Header - Dropdown -->
          <div class="card-header py d-flex flex-row align-items-center justify-content-between col-lg">
            <h6 class="m-0 font-weight-bold text-primary"><?php if($profile['role_id'] == 1) { echo 'Administrator'; } else { echo 'Employee';}?> Profile</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Action</div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('profile/edit');?>"><i class="fas fa-user-edit"></i> Edit Profile</a>
                <a class="dropdown-item" href="<?= base_url('profile/changepassword');?>"><i class="fas fa-key"></i> Change Password</a>
                <a class="dropdown-item" href="<?= base_url('profile/resetphoto/').$profile['id']; ?>"><i class="fas fa-trash-restore"></i> Reset profile photo</a>
              </div>
            </div>
          </div>

          <!-- Card Body -->
          <div class="row no-gutters">
            <div class="col-md-4">
              <img style="width: 100%; height: 100%;" src="<?= base_url('assets/uploads/foto_profil/').$profile['foto'];?>" class="card-img-left">
            </div>
            <div class="col-md-3">
              <div class="card-body">
                <h5 class="card-title">Full Name</h5>
                <p class="card-text">Username</p>
                <p class="card-text">Divisi</p>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card-body">
                <h5 class="card-title">: <?= $profile['name'];?></h5>
                <p class="card-text">: <?= $profile['username'];?></p>
                <p class="card-text">: <?= $profile['divisi'];?></p>
                <p class="card-text"><small class="text-muted">Member since <?= date('d F Y' , $profile['date_created']);?></small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= base_url('assets/img/illustrations/');?>profile.svg" alt="">
      </div>
    </div>
    <!-- End of Card -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->






    

        
     
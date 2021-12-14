<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <h6 class="mt-2">Selamat datang <span class="text-primary"><?= $profile['name']; ?></span></h6>
          <div class="topbar-divider d-none d-sm-block"></div>
          <h6 class="mt-2">Username : <span class="text-primary"><?= $profile['username'];?></span></h6>
          <div class="topbar-divider d-none d-sm-block"></div>
          <h6 class="mt-2">Divisi : <span class="text-primary"><?= $profile['divisi'];?></span></h6>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <?php if($this->session->userdata('role_id') == 1) { ?>
              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?php if($count > 0) { echo $count; }?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Notification
                  </h6>
                  <?php foreach($notification as $not) { ?>
                    <!-- 1 -->
                    <a class="dropdown-item d-flex align-items-center" href="<?= base_url($not['link']); ?>">
                      <div class="mr-3">
                        <div class="icon-circle bg-light">
                          <i class="<?= $not['icon'];?>"></i>
                        </div>
                      </div>
                      <div>
                        
                        <?php if ($not['is_clicked'] == 0) { ?>
                          <div class="font-weight-bold large text-gray-500"><?= date('d F Y H:i:s', $not['date_notified']);?></div>
                          <span class="font-weight-bold">
                            <?= $not['description']; ?>
                          </span>
                        <?php } else { ?>
                          <div class="small text-gray-500"><?= date('d F Y H:i:s', $not['date_notified']);?></div>
                          <?= $not['description']; ?>
                        <?php } ?>
                      </div>
                    </a>
                  <?php } $ci = get_instance(); ?>
                  <a class="dropdown-item text-center small text-primary" href="<?= base_url('admin/clear_notification/'.$ci->uri->segment(1).'_'.$ci->uri->segment(2));?>">Clear All Notifications</a>
                </div>
              </li>
            <?php } ?>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $profile['name'] ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/uploads/foto_profil/').$profile['foto'];?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('profile');?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  My Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
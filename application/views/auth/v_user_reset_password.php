<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto bg-gradient-light">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><?= $title ?></h1>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/reset/').$str;?>">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-4">
                      <div>Nama</div>
                    </div>
                    <div class="col-lg-8">
                      <div class="text-right">
                        <div id="link_timer"></div>
                      </div>
                    </div>
                  </div>
                  <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= $user['name']; ?>" readonly>
                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                  <label for="username" class="col-lg-4 col-form-label">Username</label>
                  <input type="text" class="form-control form-control-user" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                  <label for="divisi" class="col-lg-4 col-form-label">Divisi</label>
                  <input type="text" class="form-control form-control-user" id="divisi" name="divisi" value="<?= $user['divisi']; ?>" disabled>
                  <?= form_error('divisi', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="New Password">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Reset Password
                </button>
                <div class="text-center mt-4">
                  <a href="<?= base_url('auth');?>" class="text-danger">Home <i class="fas fa-home"></i></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
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
              <?= $this->session->flashdata('message'); ?>
              <form class="user" method="post" action="<?= base_url('auth/forgot_password');?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                  <select class="form-control" name="divisi" id="divisi">
                    <option value="" selected>-- Pilih Divisi --</option>
                    <?php foreach($divisi as $div) { ?>
                      <option class="text-secondary" value="<?= $div['divisi']; ?>"><?= $div['divisi']; ?></option>
                    <?php } ?>
                  </select>
                  <?= form_error('divisi', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Request Password Reset</button>
                <button type="button" class="btn btn-danger btn-user btn-block" onclick="window.history.back()">Back</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
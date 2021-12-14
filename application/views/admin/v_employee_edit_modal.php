<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" style="zoom:90%">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('admin/employee_edit'); ?>
        <div class="modal-body">
          <div class="form-group" required hidden>
            <label for="id_user" class="col-form-label">Id</label>
            <input type="text" class="form-control" id="id_user" name="id_user">
          </div>
          <div class="form-group" required>
            <label for="name" class="col-form-label">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="username1" class="col-form-label">Username<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username1" name="username1" required>
          </div>
          <div class="form-group">
            <label for="divisi" class="col-form-label">Divisi<span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="divisi" id="divisi">
                <option value="" selected>-- Pilih Divisi --</option>
                <?php foreach($divisi as $div) { ?>
                  <option class="text-secondary" value="<?= $div['divisi']; ?>"><?= $div['divisi']; ?></option>
                <?php } ?>
              </select>
              <?= form_error('divisi', '<small class="text-danger pl-3">', '</small>');?>
            </div>

          </div>
          <div class="form-group">
            <label for="foto" class="col-form-label">Foto (format : jpg, png)</label>
            <input type="file" class="form-control" id="foto" name="foto">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup <i class="fas fa-times-circle"></i></button>
          <button type="submit" class="btn btn-success">Simpan <i class="fas fa-save"></i></button>
        </div>
      <?= form_close();?>
    </div>
  </div>
</div>
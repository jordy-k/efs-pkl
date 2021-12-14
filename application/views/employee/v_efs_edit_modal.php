<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" style="zoom:80%">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('employee/edit'); ?>
        <div class="modal-body">
          <div class="form-group" required hidden>
            <label for="id_arsip" class="col-form-label">ID Link</label>
            <input type="text" class="form-control" id="id_arsip" name="id_arsip" required>
          </div>
          <div class="form-group" required>
            <label for="divisi" class="col-form-label">Divisi<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="divisi" name="divisi" required readonly>
          </div>
          <div class="form-group" required>
            <label for="no_berkas" class="col-form-label">No Berkas<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="no_berkas" name="no_berkas" required>
          </div>
          <div class="form-group">
            <label for="keterangan" class="col-form-label">Keterangan<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
          </div>
          <div class="form-group">
            <label for="no_arsip" class="col-form-label">Nomor Arsip / Bantek<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="no_arsip" name="no_arsip" required>
          </div>
          <div class="form-group">
            <label for="lokasi_penyimpanan" class="col-form-label">Lokasi Penyimpanan<span class="text-danger">*</span></label>
            <select class="custom-select" name="lokasi_penyimpanan" id="lokasi_penyimpanan" required>
              <option value="">-- Pilih Lokasi --</option>
              <?php foreach($lokasi as $lok) { ?>
                <option value="<?= $lok['lokasi']; ?>"><?= $lok['lokasi']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_arsip" class="col-form-label">Nama Arsip<span class="text-danger">*</span></label>
            <select class="custom-select" name="nama_arsip" id="nama_arsip" required>
              <option value="">-- Pilih Nama Arsip --</option>
              <?php foreach($nama_arsip as $na) { ?>
                <option value="<?= $na['nama_arsip']; ?>"><?= $na['nama_arsip']; ?></option>
              <?php } ?>
            </select>
          </div>
          <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
          <div class="form-group">
            <label for="tgl_arsip" class="col-form-label">Tanggal Arsip<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tgl_arsip" name="tgl_arsip" required readonly>
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script>
$('#tgl_arsip').datetimepicker({
  timepicker: false,
  datepicker: true,
  format: 'Y-m-d',
  step: 1
});
</script>
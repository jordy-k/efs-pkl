
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Add EFS Data</h6>
	    </div>
	    <div class="card-body">

    	<?= form_open_multipart('employee/proses_add'); ?>
    		<div class="form-group row" required>
    			<label for="file_arsip" class="col-lg-2 col-form-label">Upload File<span class="text-danger">*</span><br /><span class="text-secondary">( Format file : pdf )</span></label>
				<input type="file" class="form-control col-lg-9" id="file_arsip" accept="application/pdf" name="file_arsip" required value="<?= set_value('file');?>">
				<label class="col-lg-2"></label>
			</div>
			<div class="form-group row">
				<label for="keterangan" class="col-lg-2 col-form-label">Keterangan<span class="text-danger">*</span></label>
				<input type="text" class="form-control col-lg-9" id="keterangan" name="keterangan" required value="<?= set_value('keterangan');?>">
			</div>
			<div class="form-group row">
				<label for="no_arsip" class="col-lg-2 col-form-label">Nomor Arsip / Bantek<span class="text-danger">*</span></label>
				<input type="text" class="form-control col-lg-2" id="no_arsip" name="no_arsip" required  value="<?= set_value('no_arsip');?>">
			</div>
			<div class="form-group row">
				<label for="lokasi_penyimpanan" class="col-lg-2 col-form-label">Lokasi Penyimpanan<span class="text-danger">*</span></label>
				<select class="custom-select col-lg-2" name="lokasi_penyimpanan" id="lokasi_penyimpanan" required>
				  <option value="">-- Pilih Lokasi --</option>
				  <?php foreach($lokasi as $lok) { ?>
				  	<option value="<?= $lok['lokasi']; ?>"><?= $lok['lokasi']; ?></option>
				  <?php } ?>
				</select>
				<a class="mt-2 ml-2" href="<?= base_url('employee/manage_lokasi'); ?>" target="_blank" class="col-lg-3">Kelola Lokasi Penyimpanan.. <i class="fas fa-tasks"></i></a>
			</div>
			<div class="form-group row">
				<label for="nama_arsip" class="col-lg-2 col-form-label">Nama Arsip<span class="text-danger">*</span></label>
				<select class="custom-select col-lg-2" name="nama_arsip" id="nama_arsip" required>
				  <option value="">-- Pilih Nama Arsip --</option>
				  <?php foreach($nama_arsip as $na) { ?>
				  	<option value="<?= $na['nama_arsip']; ?>"><?= $na['nama_arsip']; ?></option>
				  <?php } ?>
				</select>
				<a class="mt-2 ml-2" href="<?= base_url('employee/manage_nama_arsip'); ?>" target="_blank" class="col-lg-3">Kelola Nama Arsip.. <i class="fas fa-tasks"></i></a>
			</div>
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
			<div class="form-group row">
				<label for="tgl_arsip" class="col-lg-2 col-form-label">Tanggal Arsip<span class="text-danger">*</span></label>
				<input type="text" class="form-control col-lg-2" id="tgl_arsip" name="tgl_arsip" required readonly value="<?= date('Y-m-d');?>">
			</div>
			<div class="form-group row">
				<div class="col-lg-2"></div>
				<button type="submit" class="btn btn-success col-lg-1">SIMPAN</button>
			</div>
		<?= form_close();?>
    	</div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script>
$('#tgl_arsip').datetimepicker({
  timepicker: false,
  datepicker: true,
  format: 'Y-m-d',
  step: 1
});
</script>

</div>
<!-- End of Main Content -->
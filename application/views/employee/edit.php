
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <?= $this->session->flashdata('message'); ?>

   
    <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Edit EFS Data</h6>
	    </div>
	    <div class="card-body">

    	<?= form_open_multipart('employee/proses_edit'); ?>
    		<div class="form-group row" required hidden>
    			<label for="id_arsip" class="col-lg-2 col-form-label">ID Link</label>
				<input type="text" class="form-control col-lg-1" id="id_arsip" name="id_arsip" required value="<?= $arsip_masuk['id_arsip'];?>">
			</div>
    		<div class="form-group row" required>
    			<label for="no_berkas" class="col-lg-2 col-form-label">No Berkas</label>
				<input type="text" class="form-control col-lg-9" id="no_berkas" name="no_berkas" required value="<?= $arsip_masuk['no_berkas'];?>">
			</div>
			<div class="form-group row">
				<label for="keterangan" class="col-lg-2 col-form-label">Keterangan</label>
				<input type="text" class="form-control col-lg-9" id="keterangan" name="keterangan" required value="<?= $arsip_masuk['keterangan'];?>">
			</div>
			<div class="form-group row">
				<label for="no_arsip" class="col-lg-2 col-form-label">Nomor Arsip / Bantek</label>
				<input type="text" class="form-control col-lg-2" id="no_arsip" name="no_arsip" required value="<?= $arsip_masuk['no_arsip'];?>">
			</div>
			<div class="form-group row">
				<label for="lokasi_penyimpanan" class="col-lg-2 col-form-label">Lokasi Penyimpanan</label>
				<select class="custom-select col-lg-2" name="lokasi_penyimpanan" id="lokasi_penyimpanan" required>
				  <option value="">-- Pilih Lokasi --</option>
				  <?php foreach($lokasi as $lok) { ?>
				  	<option value="<?= $lok['lokasi']; ?>" <?php if($lok['lokasi'] == $arsip_masuk['lokasi_penyimpanan']) { echo 'selected'; } ?>><?= $lok['lokasi']; ?></option>
				  <?php } ?>
				</select>
			</div>
			<div class="form-group row">
				<label for="nama_arsip" class="col-lg-2 col-form-label">Nama Arsip</label>
				<select class="custom-select col-lg-3" name="nama_arsip" id="nama_arsip" required>
				  <option value="">-- Pilih Nama Arsip --</option>
				  <?php foreach($nama_arsip as $na) { ?>
				  	<option value="<?= $na['nama_arsip']; ?>" <?php if($na['nama_arsip'] == $arsip_masuk['nama_arsip']) { echo 'selected'; } ?>><?= $na['nama_arsip']; ?></option>
				  <?php } ?>
				</select>
			</div>
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
			<div class="form-group row">
				<label for="tgl_arsip" class="col-lg-2 col-form-label">Tanggal Diterima</label>
				<input type="text" class="form-control col-lg-3" id="tgl_arsip" name="tgl_arsip" required readonly value="<?= $arsip_masuk['tgl_arsip'];?>">
			</div>
			<div class="form-group row">
				<div class="col-lg-2"></div>
				<button type="submit" class="btn btn-success col-lg-2">SIMPAN PERUBAHAN</button>
			</div>
		<?= form_close();?>
    	</div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
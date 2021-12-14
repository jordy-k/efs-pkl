<!-- Begin Page Content -->
<div class="container-fluid">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
	
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="ml-0 mb-4 col-lg-3">
      <button type="button" class="btn btn-secondary" onclick="reloadPage()">
          Reload EFS Data <i class="fas fa-sync-alt"></i>
      </button>
    </div>

    <?= form_open_multipart('employee/multi_add_confirmation'); ?>
	    <?php $i = 1; foreach($file_zip as $fz) { ?>
		    <div class="card shadow mb-4">
			    <div class="card-header py-3">
			      <h6 class="m-0 font-weight-bold text-primary">EFS Data <?= $i; ?></h6>
			    </div>
			    <div class="card-body">
		    		<div class="form-group row" required>
		    			<label for="no_berkas_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">No Berkas<span class="text-danger">*</span></label>
						<input type="text" class="form-control col-lg-9" id="no_berkas_<?= $fz['id']; ?>" name="no_berkas_<?= $fz['id']; ?>" required value="<?= $fz['no_berkas'];?>">
					</div>
					<div class="form-group row">
						<label for="keterangan_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">Keterangan<span class="text-danger">*</span></label>
						<input type="text" class="form-control col-lg-9" id="keterangan_<?= $fz['id']; ?>" name="keterangan_<?= $fz['id']; ?>" required  value="<?= set_value('keterangan_'.$fz['id']);?>">
					</div>
					<div class="form-group row" required hidden>
		    			<label for="file_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">File Enkrip<span class="text-danger">*</span></label>
						<input type="text" class="form-control col-lg-9" id="file_<?= $fz['id']; ?>" name="file_<?= $fz['id']; ?>" value="<?= $fz['file'];?>" readonly>
					</div>
					<div class="form-group row">
						<label for="no_arsip_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">Nomor Arsip / Bantek<span class="text-danger">*</span></label>
						<input type="text" class="form-control col-lg-2" id="no_arsip_<?= $fz['id']; ?>" name="no_arsip_<?= $fz['id']; ?>" required  value="<?= set_value('no_arsip_'.$fz['id']);?>">
					</div>
					<div class="form-group row">
						<label for="lokasi_penyimpanan_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">Lokasi Penyimpanan<span class="text-danger">*</span></label>
						<select class="custom-select col-lg-2" name="lokasi_penyimpanan_<?= $fz['id']; ?>" id="lokasi_penyimpanan_<?= $fz['id']; ?>" required>
						  <option value="">-- Pilih Lokasi --</option>
						  <?php foreach($lokasi as $lok) { ?>
						  	<option value="<?= $lok['lokasi']; ?>"><?= $lok['lokasi']; ?></option>
						  <?php } ?>
						</select>
						<div class="col-lg-1"></div>
						<a href="<?= base_url('employee/manage_lokasi'); ?>" target="_blank" class="col-lg-3">Kelola Lokasi.. <i class="fas fa-tasks"></i></a>
					</div>
					<div class="form-group row">
						<label for="nama_arsip_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">Nama Arsip<span class="text-danger">*</span></label>
						<select class="custom-select col-lg-3" name="nama_arsip_<?= $fz['id']; ?>" id="nama_arsip_<?= $fz['id']; ?>" required>
						  <option value="">-- Pilih Nama Arsip --</option>
						  <?php foreach($nama_arsip as $na) { ?>
						  	<option value="<?= $na['nama_arsip']; ?>"><?= $na['nama_arsip']; ?></option>
						  <?php } ?>
						</select>
						<div class="col-lg-0"></div>
						<a href="<?= base_url('employee/manage_nama_arsip'); ?>" target="_blank" class="col-lg-3">Kelola Nama Arsip.. <i class="fas fa-tasks"></i></a>
					</div>
					<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
					<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
					<div class="form-group row">
						<label for="tgl_arsip_<?= $fz['id']; ?>" class="col-lg-2 col-form-label">Tanggal Arsip<span class="text-danger">*</span></label>
						<input type="text" class="form-control col-lg-3" id="tgl_arsip_<?= $fz['id']; ?>" name="tgl_arsip_<?= $fz['id']; ?>" required readonly value="<?= date('Y-m-d');?>">
					</div>
					<script>
					$('#tgl_arsip_<?= $fz['id']; ?>').datetimepicker({
					  timepicker: false,
					  datepicker: true,
					  format: 'Y-m-d',
					  step: 1
					});
					</script>
		    	</div>
		    </div>
		<?php $i++; } ?>
	    <div class="form-group row">
			<div class="col-lg-2"></div>
			<button type="submit" class="btn btn-success col-lg-1">SIMPAN</button>
		</div>
	<?= form_close();?>

</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->
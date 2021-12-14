<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    <?= $this->session->flashdata('message'); ?>
    
    <?= form_open_multipart('employee/proses_multi_add'); ?>
	    <div class="form-group row" required>
			<label for="file_arsip_zip" class="col-lg-2 col-form-label">Choose ZIP File include many EFS Data<span class="text-danger">*</span> : </label>
			<input type="file" class="form-control col-lg-9" id="file_arsip_zip" name="file_arsip_zip" value="<?= set_value('file_arsip_zip');?>">
		</div>
		<?= form_error('file_arsip_zip', '<small class="text-danger pl-3">', '</small>');?>
		<div class="form-group row">
			<div class="col-lg-2"></div>
			<button type="submit" class="btn btn-success col-lg-1">UPLOAD</button>
		</div>
	<?= form_close(); ?>
	<hr />
	<h1 class="h3 mb-4 text-gray-800">Steps</h1>
	<div class="row">
		<div class="col-lg-6">
			<p>(1) Buat file zip di folder yang sama dengan folder berkas arsip</p>
			<img class="img-fluid pb-3 pr-3" src="<?= base_url('assets/img/templates/'); ?>example1.png">
		</div>
		<div class="col-lg-6">
			<p>(2) Beri nama file zip nya</p>
			<img class="img-fluid pb-3 pr-3" src="<?= base_url('assets/img/templates/'); ?>example2.png">
		</div>
		<div class="col-lg-6">
			<p>(3) Salin semua file EFS yang ingin diarsip dan tempelkan di file zip yang telah dibuat</p>
			<img class="img-fluid pb-3 pr-3" src="<?= base_url('assets/img/templates/'); ?>example3.png">
		</div>
		<div class="col-lg-6">
			<p>(4) Klik Browse</p>
			<img class="img-fluid pb-3 pr-3" src="<?= base_url('assets/img/templates/'); ?>example4.png">
		</div>
		<div class="col-lg-6">
			<p>(5) Pilih file zip yang sudah berisi banyak file EFS</p>
			<img class="img-fluid pb-3 pr-3" src="<?= base_url('assets/img/templates/'); ?>example5.png">
		</div>
		<div class="col-lg-6">
			<p>(6) Klik Upload</p>
			<img class="img-fluid pb-3 pr-3" src="<?= base_url('assets/img/templates/'); ?>example6.png">
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
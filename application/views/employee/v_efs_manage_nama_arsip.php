
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    <hr />
    <?= $this->session->flashdata('add'); ?>
    <?= $this->session->flashdata('delete'); ?>
    <div class="form-group row ml-2">
    	<div class="col-lg-3" id="force_closed"></div>
    </div>
    <form id="form_nama_arsip" name="form_nama_arsip" method="post" action="<?= base_url('employee/manage_nama_arsip');?>">
		<div class="form-group row">
			<label for="nama_arsip" class="col-lg-4 col-form-label">Nama arsip yang ingin dihapus</label>
			<select class="custom-select form-control col-lg-4 disableButton" id="del" name="del_nama_arsip">
			  <option value="">-- Pilih Nama Arsip --</option>
			  <?php foreach($nama_arsip as $na) { ?>
			  	<option value="<?= $na['nama_arsip']; ?>"><?= $na['nama_arsip']; ?></option>
			  <?php } ?>
			</select>
			<div class="col-lg-3">
				<button type="submit" class="btn btn-danger" id="submit_del" hidden>HAPUS <i class="fas fa-trash-alt"></i></button>
			</div>
		</div>
		<div class="form-group row">
			<label for="new_nama_arsip" class="col-lg-4 col-form-label">Nama arsip baru</label>
			<input type="text" class="form-control col-lg-4 disableButton" id="new" name="new_nama_arsip">
			<div class="col-lg-3">
				<button type="submit" class="btn btn-success" id="submit_new" hidden>TAMBAH <i class="fas fa-plus-circle"></i></button>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-lg-4"></div>
			<input type="checkbox" class="mt-1" id="force_closed" name="force_closed" value="1" <?php if(isset($_GET['force_closed'])) { if($_GET['force_closed'] == 'on') { echo 'checked';}} else { echo 'checked'; } ?>>
			<p class="ml-2">Tutup tab browser otomatis?</p>
		</div>
		<div class="form-group row">
			<div class="col-lg-4 col-form-label"></div>
			<button type="submit" class="btn btn-primary" id="submit_both" hidden>SIMPAN SEMUA PERUBAHAN <i class="fas fa-check-circle"></i></button>
		</div>
	</form>
	<div class="row">
		<div class="col-lg-6">
			<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= base_url('assets/img/illustrations/');?>throw_away.svg" alt="">
		</div>
		<div class="col-lg-6">
			<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= base_url('assets/img/illustrations/');?>add_file.svg" alt="">
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
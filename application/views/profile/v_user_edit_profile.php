<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
    	<div class="col-lg-8">
			<?= form_open_multipart('profile/edit'); ?>
				<div class="form-group row">
					<label for="username" class="col-sm-2 col-form-label">Username<span class="text-danger">*</span></label>
					<div class="col-sm-10">
				      <input type="text" class="form-control" id="username" name="username" value="<?= $profile['username']?>">
				      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Full name<span class="text-danger">*</span></label>
					<div class="col-sm-10">
				      <input type="text" class="form-control" id="name" name="name" value="<?= $profile['name']?>">
				      <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="foto" class="col-sm-2 col-form-label">Profile Photo</label>
					<div class="col-sm-10">
				      <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
				      <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
				      <div class="row mt-2">
				      	<div class="col-sm-4">
				      		(format : jpg, png)
				      	</div>
				      	<div class="col-sm-4"></div>
				      	<div class="col-sm-4">
				      		<a class="text-primary text-right" href="<?= base_url('profile/resetphoto/').$profile['id']; ?>"><i class="fas fa-trash-restore"></i> Reset profile photo</a>
				      	</div>
				  	  </div>
					</div>
					<div class="col-sm-2">
						
					</div>
					<div class="col-sm-5 pt-2">
						
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</div>
			<?= form_close(); ?>
		</div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

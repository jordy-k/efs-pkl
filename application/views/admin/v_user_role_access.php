<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    
    <div class="row">
    	<div class="col-lg-6">
    		<?= $this->session->flashdata('message'); ?>

    		<h6>Role : <?= $role['role']?></h6>

	    	<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Menu</th>
			      <th scope="col">Access</th>
			    </tr>
			  </thead>
			  <tbody>

			  	<?php 
			  	$i = 1;
			  	foreach($menu as $m) { ?>
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $m['menu']; ?></td>
				      <td>
				      	<div class="form-check">
						  <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']);?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id'];?>">
						</div>
				      </td>
				    </tr>
				<?php 
					$i++; } 
				?>
			  </tbody>
			</table>
			<a href="<?= base_url('admin/role');?>"><button class="btn btn-primary">Back</button></a>
		</div>
		<div class="col-lg-6">
			<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= base_url('assets/img/illustrations/');?>in_the_office.svg" alt="">
		</div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
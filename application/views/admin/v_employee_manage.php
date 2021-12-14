<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
    	<div class="col-lg-9">
    		<h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    		<hr />
    	</div>	
    	<div class="col-lg-3 mb-3">
    		<div class="toast" data-autohide="false">
				<div class="toast-header">
					<strong class="mr-auto text-primary">NEW EFS</strong>
					<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
				</div>
				<div class="toast-body">
					Menampilkan <?= sizeof($user); ?> data employee
				</div>
			</div>
    	</div>
    </div>

    <?= $this->session->flashdata('message');?>
	
	<form method="get" action="<?= base_url('admin/manage'); ?>">
		<div class="row">
			<div class="col-lg-1 pt-2">
				<h6>Sort by : </h6>
			</div>
			<div class="col-lg-2">
		    	<select class="form-control" name="orderby" id="orderby">
					<option value="username" <?php if(isset($_GET['orderby'])) { if($_GET['orderby'] == 'username') { echo 'selected';}}?>>Username</option>
					<option value="name" <?php if(isset($_GET['orderby'])) { if($_GET['orderby'] == 'name') { echo 'selected';}}?>>Nama</option>
					<option value="divisi" <?php if(isset($_GET['orderby'])) { if($_GET['orderby'] == 'divisi') { echo 'selected';}}?>>Divisi</option>
					<option value="date_created" <?php if(isset($_GET['orderby'])) { if($_GET['orderby'] == 'date_created') { echo 'selected';}}?>>Date of Entry</option>
					<option value="active_time" <?php if(isset($_GET['orderby'])) { if($_GET['orderby'] == 'active_time') { echo 'selected';}}?>>Online Time</option>
				</select>
		    </div>
		    <div class="col-lg-2">
		    	<select class="form-control" name="sort" id="sort">
					<option value="asc" <?php if(isset($_GET['orderby'])) { if($_GET['sort'] == 'asc') { echo 'selected';}}?>>Ascending</option>
					<option value="desc" <?php if(isset($_GET['orderby'])) { if($_GET['sort'] == 'desc') { echo 'selected';}}?>>Descending</option>
				</select>
		    </div>
		    <div class="col-lg-1 pt-2">
				<h6>Search : </h6>
			</div>
		    <div class="col-lg-2">
		    	<input class="form-control" type="text" name="search" value="<?php if(isset($_GET['search'])) { echo $_GET['search']; } ?>">
		    </div>
		    <div class="col-lg-1">
				<h6>Search Filter : </h6>
			</div>
		    <div class="col-lg-2">
		    	<select class="form-control" name="filter" id="filter" value="<?php if(isset($_GET['filter'])) { echo $_GET['filter']; } ?>">
		    		<option value="all" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'all') { echo 'selected';}}?>>All</option>
					<option value="username" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'username') { echo 'selected';}}?>>Username</option>
					<option value="name" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'name') { echo 'selected';}}?>>Nama</option>
					<option value="divisi" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'divisi') { echo 'selected';}}?>>Divisi</option>
					<option value="active" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'active') { echo 'selected';}}?>>Active Account</option>
					<option value="nonactive" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'nonactive') { echo 'selected';}}?>>Non-Active Account</option>
					<option value="online" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'online') { echo 'selected';}}?>>Online Now</option>
					<option value="offline" <?php if(isset($_GET['filter'])) { if($_GET['filter'] == 'offline') { echo 'selected';}}?>>Offline Now</option>
				</select>
		    </div>
			<div class="col-lg-1">
				<button class="form-control btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>

    <div class="mb-2"></div>
    <?php
    	$i = 1;
    	foreach ($user as $u) { 
    ?>

    	<div class="animated fadeinupbig delay-10s">
	    <!-- Card -->

	    <div class="card shadow mb-3 border-left-primary" id="employee<?= $u['id']; ?>">
	      <!-- Card Header - Dropdown -->
	      <div class="card-header py d-flex flex-row align-items-center justify-content-between col-lg">
	        <a href="#employee<?= $u['id']; ?>"><h6 class="m-0 font-weight-bold text-primary">Employee <?= $i.$u['active_status']; ?></h6></a>
	        <div class="dropdown no-arrow">
	          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
	          </a>
	          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
	            <div class="dropdown-header">Action</div>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item" href="<?= base_url('admin/resetphoto/').$u['id']; ?>"><i class="fas fa-trash-restore"></i> Reset profile photo</a>
	            <a class="dropdown-item" href="<?= base_url('admin/resetpassword/').$u['id']; ?>"><i class="fas fa-wrench"></i> Get password reset link</a>
	          </div>
	        </div>
	      </div>

	      <!-- Card Body -->
	      <div class="row no-gutters">
	        <div class="col-md-3">
	          <img style="width: 90%; height: 100%;" src="<?= base_url('assets/uploads/foto_profil/').$u['foto']?>" class="card-img-left">
	        </div>
	        <div class="col-md-2">
	          <div class="card-body">
	            <h5 class="card-title">Full Name</h5>
	            <p class="card-text">Username</p>
	            <p class="card-text">Divisi</p>
	          </div>
	        </div>
	        <div class="col-md-3">
	          <div class="card-body">
	            <h5 class="card-title">: <?= $u['name'];?></h5>
	            <p class="card-text">: <?= $u['username'];?></p>
	            <p class="card-text">: <?= $u['divisi'];?></p>
	            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y' , $u['date_created']);?></small></p>
	          </div>
	        </div>
	        <div class="col-md-4">
	        	<div class="card-body">
		            <div class="ml-2 mt-4">
					        <button 
					        	type="submit" 
					        	class="btn <?= clr_activation($u['id'], $u['is_active']);?> btn-block" 
					        	data-toggle="tooltip" 
					        	title="<?php if(clr_activation($u['id'], $u['is_active']) == 'btn-success') { echo 'Click to Deactivate'; } else { echo 'Click to Activate'; }?>"
					        	onclick="location.href='<?= base_url('admin/changeactivation/').$u['id'];?>'"
					        >
					        	<?= icon_activation($u['id'], $u['is_active']);?>
					        </button>
				      	<a data-toggle="modal" data-target="#editModal" onclick="showedit_employee(<?= $u['id']; ?>)">
				      		<button style="width:100%" type="button" class="btn btn-warning">
				      			Edit <i class="fas fa-edit"></i>
				      		</button>
				      	</a>
				      	<a data-toggle="modal" data-target="#deleteModal" onclick="showdelete_employee(<?= $u['id']; ?>)">
				      		<button style="width:100%" class="btn btn-danger">
				      			Delete <i class="fas fa-trash"></i>
				      		</button>
				      	</a>
					</div>
		        </div>
			</div>
	      </div>

	    </div>
	    <!-- End of Card -->
		</div>

    <?php 
    $i++;

	} ?>
     
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
    <hr />
    <?= $this->session->flashdata('message');?>

    <div class="row">
      <div class="col-lg-2">
        <div>URL for Account Recovery</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5">
        <input type="text" class="form-control" id="reset" value="<?= $link_reset; ?>" readonly>
      </div>
      <div class="col-lg-2">
        <button 
          type="button" 
          class="form-control btn btn-secondary" 
          id="copy" 
          onclick="copylink()" 
          data-toggle="tooltip" 
          title="Copy to Clipboard">Copy URL <i class="fas fa-copy"></i>
        </button>
      </div>  
      <div class="col-lg-3">
        <a href="<?= $link_reset; ?>" target="_blank">
          <button type="button" class="form-control btn btn-success" id="newtab">Open in new tab <i class="fas fa-paper-plane"></i>
          </button>
        </a>
      </div>
      <div class="col-lg-2">
        <button type="button" class="form-control btn btn-primary" onclick="reloadPage()">Refresh URL <i class="fas fa-sync-alt"></i>
        </button>
      </div>   
    </div>
    <div class="row">
      <div class="col-lg-5">
        <div class="text-right">
          <div id="link_timer"></div>
        </div>
      </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
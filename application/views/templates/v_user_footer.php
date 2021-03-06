 <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; EFS KISEL 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin untuk Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih tombol "Logout" di bawah untuk mengakhiri sesi anda.</div>
        <div class="modal-footer">
          <a class="btn btn-success" href="<?= base_url('auth/logout'); ?>">Logout <i class="fas fa-sign-out-alt"></i></a>
          <button class="btn btn-danger" type="button" data-dismiss="modal">Batal <i class="fas fa-times-circle"></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->

  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  

  <!-- other source -->
  
  
  <script>
    function reloadPage() {
      location = location;
    }

    function preloader() {
      var myVar = setTimeout(showPage, 100);
    }

    function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("wrapper").style.display = "flex";
    }
  </script>


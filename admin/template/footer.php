</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
<footer class="sticky-footer">
  <div class="container">
    <div class="text-center">
      <small>Copyright © Sistem Paparan Digital v1.2 2018</small>
    </div>
  </div>
</footer>
<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bersedia untuk keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Logout" di bawah jika anda bersedia untuk keluar.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?php echo $home_url . 'admin/'; ?>logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>


<!-- Core plugin JavaScript-->
<script src="<?php echo $home_url; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="<?php echo $home_url; ?>vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $home_url; ?>vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo $home_url; ?>js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="<?php echo $home_url; ?>js/sb-admin-datatables.min.js"></script>
<script src="<?php echo $home_url; ?>vendor/momentjs/moment.js"></script>
<script src="<?php echo $home_url; ?>vendor/bootstrapTimePicker/tempusdominus-bootstrap-4.min.js"></script>

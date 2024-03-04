</div>
</div>
<footer class="footer pt-5">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          made with <i class="fa fa-heart"></i>
          for a better web.
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
</main>
<!--   Core JS Files   -->

<script src="<?php echo $base_path; ?>/assets/js/jquery-3.7.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php echo $base_path; ?>/assets/customs/dataTables/dataTables.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo $base_path; ?>/assets/js/dataTables.min.js"></script>
<script src="<?php echo $base_path; ?>/assets/js/core/popper.min.js"></script>
<script src="<?php echo $base_path; ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo $base_path; ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo $base_path; ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo $base_path; ?>/assets/customs/template/template.js?v=<?php echo rand() ?>"></script>
<?php
if (isset($_GET['page'])) {
  echo '<script src="views/assets/customs/' . $_GET['page'] . '/' . $_GET['page'] . '.js?v=' . rand() . '"></script>';
}
?>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo $base_path; ?>/assets/js/material-dashboard.min.js?v=3.1.0"></script>
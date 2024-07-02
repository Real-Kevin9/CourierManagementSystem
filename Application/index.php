<!DOCTYPE html>
<html lang="en">
<?php 
  session_start();
  if (!isset($_SESSION['login_id'])) {
    header('location:login.php');
  }
  include 'components/header.php'; 
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include 'components/topbar.php'; ?>
    <?php include 'components/sidebar.php'; ?>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <?php 
            if (isset($_GET['page']) && !empty($_GET['page'])) {
              $page = $_GET['page'];
              include $page . '.php';
            } else {
              include 'home.php';
            }
          ?>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <section class="col-lg-12 connectedSortable">
            </section>
          </div>
        </div>
      </section>
    </div>
    <?php include 'components/footer.php'; ?>
  </div>
</body>
</html>

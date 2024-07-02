<?php include('db_connect.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles/home.css">
</head>
<body>
<?php
$twhere = "";
if ($_SESSION['login_type'] != 1) {
  $twhere = " ";
}
?>
<!-- Info boxes -->
<?php if ($_SESSION['login_type'] == 1): ?>
  <h3>Welcome <?php echo $_SESSION['login_name'] ?></h3>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM branches")->num_rows; ?></h3>
          <p>Total Branches</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM parcels")->num_rows; ?></h3>
          <p>Total Parcels</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM users WHERE type != 1")->num_rows; ?></h3>
          <p>Total Staff</p>
        </div>
      </div>
    </div>
    <hr>
    <?php 
      $status_arr = array("Item Accepted by Courier", "Collected", "Shipped", "In-Transit", "Arrived At Destination", "Out for Delivery", "Ready to Pickup", "Delivered", "Picked-up", "Unsuccessful Delivery Attempt");
      foreach($status_arr as $status_index => $status_label): 
    ?>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM parcels WHERE status = {$status_index}")->num_rows; ?></h3>
          <p><?php echo $status_label ?></p>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        Welcome <?php echo $_SESSION['login_name'] ?>!
      </div>
    </div>
  </div>
<?php endif; ?>
</body>
</html>

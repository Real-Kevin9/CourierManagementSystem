<aside id="sidebar" class="main-sidebar">
  <div class="dropdown">
    <a href="./" class="brand-link">
      <?php if ($_SESSION['login_type'] == 1): ?>
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
      <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>STAFF</b></h3>
      <?php endif; ?>
    </a>
    <a href="#" class="nav-link nav-close" id="close-sidebar">
      <span>&times;</span>
    </a>
  </div>
  <div class="sidebar pb-4 mb-4">
    <nav class="mt-2">
      <ul class="nav flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <p>Dashboard</p>
          </a>
        </li>
        <?php if ($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=new_branch" class="nav-link nav-new_branch">
              <p>Add New Branch</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=branch_list" class="nav-link nav-branch_list">
              <p>List Branches</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=new_staff" class="nav-link nav-new_staff">
              <p>Add New Staff</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=staff_list" class="nav-link nav-staff_list">
              <p>List Staff</p>
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a href="./index.php?page=new_parcel" class="nav-link nav-new_parcel">
            <p>Add New Parcel</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./index.php?page=parcel_list" class="nav-link nav-parcel_list">
            <p>List All Parcels</p>
          </a>
        </li>
        <?php 
        $status_arr = array("Item Accepted by Courier", "Collected", "Shipped", "In-Transit", "Arrived At Destination", "Out for Delivery", "Ready to Pickup", "Delivered", "Picked-up", "Unsuccessful Delivery Attempt");
        foreach ($status_arr as $k => $v): ?>
          <li class="nav-item">
            <a href="./index.php?page=parcel_list&s=<?php echo $k ?>" class="nav-link nav-parcel_list_<?php echo $k ?>">
              <p><?php echo $v ?></p>
            </a>
          </li>
        <?php endforeach; ?>
        <li class="nav-item">
          <a href="./index.php?page=track" class="nav-link nav-track">
            <p>Track Parcel</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<style>
  body {
    overflow-x: hidden;
    font-family: 'Roboto', sans-serif;
  }

  h3 {
    color: #8B0000;
  }

  #sidebar {
    transition: transform 0.3s ease-in-out;
    transform: translateX(-250px);
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    z-index: 1040;
    overflow-y: auto;
    background-color: #ffffff;
  }

  #sidebar.active {
    transform: translateX(0);
  }

  .content-wrapper {
    transition: margin-left 0.3s ease-in-out;
    margin-left: 0;
  }

  #sidebar.active ~ .content-wrapper {
    margin-left: 250px;
  }

  .main-sidebar {
    background-color: #ffffff;
  }

  .main-sidebar .nav-link {
    color: #8B0000;
  }

  .main-sidebar .nav-link:hover {
    background-color: #ffcbd1;
    color: #8B0000;
  }

  .main-sidebar .nav-link.active {
    background-color: #7B0C0C;
    color: #ffffff;
  }

  .main-sidebar .nav-icon {
    margin-right: 10px;
  }

  .nav-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    color: #8B0000;
    text-decoration: none;
  }

  .nav-close:hover {
    color: #7B0C0C;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Activate sidebar links based on the current page
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
    if (s != '') page = page + '_' + s;
    var activeLink = document.querySelector('.nav-link.nav-' + page);
    if (activeLink) {
      activeLink.classList.add('active');
      var parentTreeview = activeLink.closest('.nav-treeview');
      if (parentTreeview) {
        parentTreeview.previousElementSibling.classList.add('active');
        parentTreeview.parentElement.classList.add('menu-open');
      }
    }

    // Close sidebar
    document.getElementById('close-sidebar').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('sidebar').classList.remove('active');
    });
  });
</script>

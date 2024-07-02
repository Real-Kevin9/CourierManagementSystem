<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <?php if (isset($_SESSION['login_id'])): ?>
      <li class="nav-item">
        <a class="nav-link" id="pushmenu" href="#" role="button">&#9776;</a>
      </li>
    <?php endif; ?>
    <li class="nav-item">
      <a class="nav-link text-white" href="./" role="button">
        <span><b><?php echo $_SESSION['system']['name']; ?></b></span>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="d-flex align-items-center">
          <span><b><?php echo ucwords($_SESSION['login_firstname']); ?></b></span>
          <span class="ml-2">&#x25BC;</span>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="manage_user.php?id=<?php echo $_SESSION['login_id']; ?>">Manage Account</a>
        <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
      </div>
    </li>
  </ul>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Manage Account Modal
    var manageAccountBtn = document.getElementById('manage_account');
    if (manageAccountBtn) {
      manageAccountBtn.addEventListener('click', function(event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'manage_user.php?id=<?php echo $_SESSION['login_id']; ?>', true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('manageAccountModalBody').innerHTML = xhr.responseText;
            var manageAccountModal = new bootstrap.Modal(document.getElementById('manageAccountModal'));
            manageAccountModal.show();
          }
        };
        xhr.send();
      });
    }

    // Save User Details
    var saveUserDetailsBtn = document.getElementById('saveUserDetails');
    if (saveUserDetailsBtn) {
      saveUserDetailsBtn.addEventListener('click', function(event) {
        event.preventDefault();
        var form = document.getElementById('manage-user-form');
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax.php?action=update_user', true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText == '1') {
              alert('User updated successfully');
              location.reload();
            } else {
              alert('An error occurred');
            }
          }
        };
        xhr.send(formData);
      });
    }

    // Sidebar Toggle
    document.getElementById('pushmenu').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('sidebar').classList.toggle('active');
    });

    // Dropdown Toggle
    var userDropdown = document.getElementById('userDropdown');
    var dropdownMenu = userDropdown.nextElementSibling;

    userDropdown.addEventListener('click', function(event) {
      event.preventDefault();
      dropdownMenu.classList.toggle('show');
    });

    document.addEventListener('click', function(event) {
      if (!userDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove('show');
      }
    });
  });
</script>

<style>
  nav {
    font-family: 'Roboto', sans-serif;
  }

  .main-header.navbar {
    background-color: #7b0c0c;
    border-bottom: 1px solid #004085;
  }

  .navbar-nav .nav-link {
    color: #ffffff;
  }

  .navbar-nav .nav-link:hover {
    color: #cce5ff;
  }

  .navbar-nav .dropdown-menu {
    background-color: #ffffff;
    color: #8B0000;
  }

  .navbar-nav .dropdown-item {
    color: #8B0000;
  }

  .navbar-nav .dropdown-item:hover {
    background-color: #ffcbd1;
    color: #8B0000;
  }

  .nav-item .badge-pill {
    display: flex;
    align-items: center;
  }

  .dropdown-menu.show {
    display: block;
  }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    include('./db_connect.php');

    if (!isset($_SESSION['system'])) {
        $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
        foreach ($system as $key => $value) {
            $_SESSION['system'][$key] = $value;
        }
    }
    ?>

    <?php 
    if (isset($_SESSION['login_id'])) {
        header("location:index.php?page=home");
    }
    ?>

    <?php include 'components/header.php'; ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b><?php echo $_SESSION['system']['name']; ?></b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <form action="" id="login-form">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" required placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bi bi-envelope-fill"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" required placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bi bi-lock-fill"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="scripts/login.js"></script>
</body>
</html>

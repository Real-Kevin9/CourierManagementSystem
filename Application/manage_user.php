<?php 
include('db_connect.php');
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_email = $conn->query("SELECT * FROM users WHERE email = '$email' AND id != $id");
    if ($check_email->num_rows > 0) {
        echo 2;
        exit;
    }

    if (empty($password)) {
        $conn->query("UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = $id");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password' WHERE id = $id");
    }
    echo 1;
    exit;
}

if (isset($_GET['id'])) {
    $user = $conn->query("SELECT * FROM users WHERE id = " . $_GET['id']);
    foreach ($user->fetch_array() as $key => $value) {
        $meta[$key] = $value;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/manage_users.css">
</head>
<body>
<div class="container-fluid">
    <div id="msg"></div>
    
    <form action="" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : ''; ?>">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email'] : ''; ?>" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="">
            <small><i>Leave this blank if you don't want to change the password.</i></small>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" id="cancel-button" class="btn btn-secondary" onclick="window.location.href = 'index.php'">Close</button>
        </div>
    </form>
</div>
<script src="scripts/manage_users.js"></script>
</body>
</html>

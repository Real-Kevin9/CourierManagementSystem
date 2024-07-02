<?php
include 'db_connect.php';

// Define status options
$status_arr = array(
    "Item Accepted by Courier",
    "Collected",
    "Shipped",
    "In-Transit",
    "Arrived At Destination",
    "Out for Delivery",
    "Ready to Pickup",
    "Delivered",
    "Picked-up",
    "Unsuccessful Delivery Attempt"
);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Debugging outputs
    error_log("Received ID: $id");
    error_log("Received Status: $status");

    // Check if ID and status are received
    if (!isset($id) || !isset($status)) {
        die("Invalid input");
    }

    // Update query
    $update_query = "UPDATE parcels SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    if ($stmt === false) {
        die("Error in query preparation");
    }

    $stmt->bind_param('si', $status, $id);
    $result = $stmt->execute();

    if ($result) {
        echo "Status updated successfully";
        header("Location: index.php?page=parcel_list");
        exit();
    } else {
        echo "Failed to update status";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Parcel Status</title>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container-fluid {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .custom-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .modal-footer {
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }
        .btn {
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #7B0C0C;
        }
        .btn-secondary {
            background-color: #555;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <form action="update_status.php" method="post" id="update_status">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <div class="form-group">
                <label for="status">Update Status</label>
                <select name="status" class="custom-select custom-select-sm" required>
                    <?php foreach($status_arr as $k => $v): ?>
                        <option value="<?php echo $k ?>" <?php echo (isset($_GET['cs']) && $_GET['cs'] == $k) ? "selected" : ''; ?>><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="modal-footer display p-0 m-0">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href = 'index.php?page=parcel_list'">Close</button>
            </div>
        </form>
    </div>
</body>
</html>

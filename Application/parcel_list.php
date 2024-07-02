<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel List</title>
    <link rel="stylesheet" href="styles/parcel_list.css">
</head>
<body>
    <div class="container-fluid">
        <div class="card card-outline card-primary mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Parcel List</h3>
                <div class="card-tools">
                    <a class="btn btn-sm btn-flat btn-add-new" href="./index.php?page=new_parcel">+ Add New</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="list">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Reference Number</th>
                                <th>Sender Name</th>
                                <th>Recipient Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $where = "";
                            if (isset($_GET['s'])) {
                                $where = " where status = {$_GET['s']} ";
                            }
                            if ($_SESSION['login_type'] != 1) {
                                if (empty($where))
                                    $where = " where ";
                                else
                                    $where .= " and ";
                                $where .= " (from_branch_id = {$_SESSION['login_branch_id']} or to_branch_id = {$_SESSION['login_branch_id']}) ";
                            }
                            $qry = $conn->query("SELECT * from parcels $where order by unix_timestamp(date_created) desc ");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td><b><?php echo ($row['reference_number']); ?></b></td>
                                    <td><b><?php echo ucwords($row['sender_name']); ?></b></td>
                                    <td><b><?php echo ucwords($row['recipient_name']); ?></b></td>
                                    <td class="text-center">
                                        <?php
                                        switch ($row['status']) {
                                            case '1':
                                                echo "<span class='badge badge-pill badge-info'> Collected</span>";
                                                break;
                                            case '2':
                                                echo "<span class='badge badge-pill badge-info'> Shipped</span>";
                                                break;
                                            case '3':
                                                echo "<span class='badge badge-pill badge-primary'> In-Transit</span>";
                                                break;
                                            case '4':
                                                echo "<span class='badge badge-pill badge-primary'> Arrived At Destination</span>";
                                                break;
                                            case '5':
                                                echo "<span class='badge badge-pill badge-primary'> Out for Delivery</span>";
                                                break;
                                            case '6':
                                                echo "<span class='badge badge-pill badge-primary'> Ready to Pickup</span>";
                                                break;
                                            case '7':
                                                echo "<span class='badge badge-pill badge-success'>Delivered</span>";
                                                break;
                                            case '8':
                                                echo "<span class='badge badge-pill badge-success'> Picked-up</span>";
                                                break;
                                            case '9':
                                                echo "<span class='badge badge-pill badge-danger'> Unsuccessful Delivery Attempt</span>";
                                                break;
                                            default:
                                                echo "<span class='badge badge-pill badge-info'> Item Accepted by Courier</span>";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-flat view_parcel" data-id="<?php echo $row['id']; ?>">View</button>
                                            <a href="index.php?page=edit_parcel&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-flat">Edit</a>
                                            <button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="parcelDetailsModal" tabindex="-1" role="dialog" aria-labelledby="parcelDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="parcelDetailsModalLabel">Parcel's Details</h5>
                    <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="parcelDetails"></div>
            </div>
        </div>
    </div>

    <script src="scripts/parcel_list.js"></script>
</body>
</html>

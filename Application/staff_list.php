<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="styles/staff_list.css">
</head>
<body>
    <div class="container">
        <div class="card card-outline card-primary mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Staff List</h3>
                <div class="card-tools">
                    <a class="btn btn-sm btn-primary btn-flat btn-add-new" href="./index.php?page=new_staff">
                        + Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped" id="list">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Staff</th>
                                <th>Email</th>
                                <th>Branch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT u.*, CONCAT(u.firstname,' ',u.lastname) AS name, CONCAT(b.street,', ',b.city,', ',b.state,', ',b.zip_code,', ',b.country) AS baddress FROM users u INNER JOIN branches b ON b.id = u.branch_id WHERE u.type = 2 ORDER BY CONCAT(u.firstname,' ',u.lastname) ASC ");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><b><?php echo ucwords($row['name']) ?></b></td>
                                    <td><b><?php echo ($row['email']) ?></b></td>
                                    <td><b><?php echo ucwords($row['baddress']) ?></b></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="index.php?page=edit_staff&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-flat delete_staff" data-id="<?php echo $row['id'] ?>">
                                                Delete
                                            </button>
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

    <script src="scripts/staff_list.js"></script>
</body>
</html>

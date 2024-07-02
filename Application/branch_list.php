<?php include 'db_connect.php' ?>
<div class="container">
    <div class="card card-outline card-primary mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Branch List</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary btn-flat btn-add-new" href="./index.php?page=new_branch">
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
                            <th>Branch Code</th>
                            <th>Street/Building/Brgy.</th>
                            <th>City/State/Zip</th>
                            <th>Country</th>
                            <th>Contact #</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM branches ORDER BY street ASC, city ASC, state ASC");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td><b><?php echo $row['branch_code'] ?></b></td>
                            <td><b><?php echo ucwords($row['street']) ?></b></td>
                            <td><b><?php echo ucwords($row['city'] . ', ' . $row['state'] . ', ' . $row['zip_code']) ?></b></td>
                            <td><b><?php echo ucwords($row['country']) ?></b></td>
                            <td><b><?php echo $row['contact'] ?></b></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="index.php?page=edit_branch&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_branch" data-id="<?php echo $row['id'] ?>">
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
<link rel="stylesheet" href="styles/branch_list.css">
<script src="scripts/branch_list.js"></script>

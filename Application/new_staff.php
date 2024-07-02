<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff</title>
    <link rel="stylesheet" href="styles/new_staff.css">
</head>
<body>
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <h3 class="title pl-3">Add Staff</h3>
            <div class="card-body">
                <form action="" id="manage-staff">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="msg" class=""></div>

                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="firstname" class="control-label">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" value="<?php echo isset($firstname) ? $firstname : '' ?>" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="lastname" class="control-label">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" value="<?php echo isset($lastname) ? $lastname : '' ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="branch_id" class="control-label">Branch</label>
                                    <select name="branch_id" id="branch_id" class="form-control form-control-sm select2">
                                        <option value=""></option>
                                        <?php
                                        $branches = $conn->query("SELECT *, concat(street, ', ', city, ', ', state, ', ', zip_code, ', ', country) as address FROM branches");
                                        while($row = $branches->fetch_assoc()):
                                        ?>
                                            <option value="<?php echo $row['id'] ?>" <?php echo isset($branch_id) && $branch_id == $row['id'] ? "selected" : '' ?>><?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="<?php echo isset($email) ? $email : '' ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm" <?php echo isset($id) ? '' : 'required' ?>>
                                    <?php if(isset($id)): ?>
                                        <small class="form-text text-muted"><i>Leave this blank if you don't want to change it</i></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer border-top border-info">
                <div class="d-flex w-100 justify-content-center align-items-center">
                    <button class="btn btn-flat bg-gradient-primary mx-2" form="manage-staff">Save</button>
                    <a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=staff_list">Cancel</a>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts/new_staff.js"></script>
</body>
</html>

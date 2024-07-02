<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Parcel</title>
    <link rel="stylesheet" href="styles/new_parcel.css">
</head>
<body class="hold-transition login-page">
    <div class="main col-lg-12">
        <div class="card card-outline card-primary">
            <h3 class="title pl-3">Add Parcel</h3>
            <div class="card-body">
                <form action="" id="manage-parcel">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                    <div id="msg"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Sender Information</b>
                            <div class="form-group">
                                <label for="" class="control-label">Name</label>
                                <input type="text" name="sender_name" class="form-control form-control-sm" value="<?php echo isset($sender_name) ? $sender_name : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Address</label>
                                <input type="text" name="sender_address" class="form-control form-control-sm" value="<?php echo isset($sender_address) ? $sender_address : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Contact #</label>
                                <input type="text" name="sender_contact" class="form-control form-control-sm" value="<?php echo isset($sender_contact) ? $sender_contact : ''; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <b>Recipient Information</b>
                            <div class="form-group">
                                <label for="" class="control-label">Name</label>
                                <input type="text" name="recipient_name" class="form-control form-control-sm" value="<?php echo isset($recipient_name) ? $recipient_name : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Address</label>
                                <input type="text" name="recipient_address" class="form-control form-control-sm" value="<?php echo isset($recipient_address) ? $recipient_address : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Contact #</label>
                                <input type="text" name="recipient_contact" class="form-control form-control-sm" value="<?php echo isset($recipient_contact) ? $recipient_contact : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dtype">Type</label>
                                <div class="container row">
                                    <p class="pt-3 pr-3">Delivery?</p>
                                    <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" data-offstyle="info" data-width="1rem" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="branchFields" <?php echo isset($type) && $type == 1 ? 'style="display: none"' : ''; ?>>
                            <?php if($_SESSION['login_branch_id'] <= 0): ?>
                            <div class="form-group" id="fbi-field">
                                <label for="" class="control-label">Branch Processed</label>
                                <select name="from_branch_id" id="from_branch_id" class="form-control select2" required>
                                    <option value=""></option>
                                    <?php 
                                        $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                                        while($row = $branches->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id']; ?>" <?php echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected" : ''; ?>>
                                        <?php echo $row['branch_code'] . ' | ' . ucwords($row['address']); ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="from_branch_id" value="<?php echo $_SESSION['login_branch_id']; ?>">
                            <?php endif; ?>
                            <div class="form-group" id="tbi-field">
                                <label for="" class="control-label">Pickup Branch</label>
                                <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                                    <option value=""></option>
                                    <?php 
                                        $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                                        while($row = $branches->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id']; ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected" : ''; ?>>
                                        <?php echo $row['branch_code'] . ' | ' . ucwords($row['address']); ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <b>Parcel Information</b>
                    <table class="table table-bordered" id="parcel-items">
                        <thead>
                            <tr>
                                <th>Weight (kg)</th>
                                <th>Height (in)</th>
                                <th>Length (in)</th>
                                <th>Width (in)</th>
                                <th>Price (in)</th>
                                <?php if(!isset($id)): ?>
                                <th></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name='weight[]' value="<?php echo isset($weight) ? $weight : ''; ?>" required class="form-control form-control-sm"></td>
                                <td><input type="text" name='height[]' value="<?php echo isset($height) ? $height : ''; ?>" required class="form-control form-control-sm"></td>
                                <td><input type="text" name='length[]' value="<?php echo isset($length) ? $length : ''; ?>" required class="form-control form-control-sm"></td>
                                <td><input type="text" name='width[]' value="<?php echo isset($width) ? $width : ''; ?>" required class="form-control form-control-sm"></td>
                                <td><input type="text" class="text-right number form-control form-control-sm" name='price[]' value="<?php echo isset($price) ? $price : ''; ?>" required></td>
                            </tr>
                        </tbody>
                        <?php if(!isset($id)): ?>
                        <tfoot>
                            <th colspan="4" class="text-right">Total</th>
                            <th class="text-right" id="tAmount">0.00</th>
                            <th></th>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                    <?php if(!isset($id)): ?>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-sm btn-primary" type="button" id="new_parcel">Add Item</button>
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
            <div class="card-footer border-top border-info">
                <div class="d-flex w-100 justify-content-center align-items-center">
                    <button class="btn btn-flat bg-gradient-primary mx-2" form="manage-parcel">Save</button>
                    <a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=parcel_list">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <div id="ptr_clone" class="main d-none">
        <table>
            <tr>
                <td><input type="text" name='weight[]' required class="form-control form-control-sm"></td>
                <td><input type="text" name='height[]' required class="form-control form-control-sm"></td>
                <td><input type="text" name='length[]' required class="form-control form-control-sm"></td>
                <td><input type="text" name='width[]' required class="form-control form-control-sm"></td>
                <td><input type="text" class="text-right number form-control form-control-sm" name='price[]' required></td>
                <td><button class="btn btn-sm btn-danger" type="button" onclick="removeRow(this)">Remove</button></td>
            </tr>
        </table>
    </div>
    <script src="scripts/new_parcel.js"></script>
</body>
</html>

<?php if(!isset($conn)) { include 'db_connect.php'; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Branch</title>
    <link rel="stylesheet" href="styles/new_branch.css">
</head>
<body class="hold-transition login-page">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-outline card-primary">
                <h3 class="title pl-3">Add Branch</h3>
                <div class="card-body">
                    <form action="" id="manage-branch">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="msg"></div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="street" class="control-label">Street/Building</label>
                                        <textarea name="street" id="street" cols="30" rows="2" class="form-control"><?php echo isset($street) ? $street : ''; ?></textarea>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="city" class="control-label">City</label>
                                        <textarea name="city" id="city" cols="30" rows="2" class="form-control"><?php echo isset($city) ? $city : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="state" class="control-label">State</label>
                                        <textarea name="state" id="state" cols="30" rows="2" class="form-control"><?php echo isset($state) ? $state : ''; ?></textarea>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="zip_code" class="control-label">Zip Code/ Postal Code</label>
                                        <textarea name="zip_code" id="zip_code" cols="30" rows="2" class="form-control"><?php echo isset($zip_code) ? $zip_code : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="country" class="control-label">Country</label>
                                        <textarea name="country" id="country" cols="30" rows="2" class="form-control"><?php echo isset($country) ? $country : ''; ?></textarea>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="contact" class="control-label">Contact #</label>
                                        <textarea name="contact" id="contact" cols="30" rows="2" class="form-control"><?php echo isset($contact) ? $contact : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer border-top border-info">
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <button class="btn btn-flat bg-gradient-primary mx-2" type="submit" form="manage-branch">Save</button>
                        <a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=branch_list">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/new_branch.js"></script>
</body>
</html>

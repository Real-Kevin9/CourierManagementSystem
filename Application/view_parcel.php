<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM parcels where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
    $$k = $v;
}
if($to_branch_id > 0 || $from_branch_id > 0){
    $to_branch_id = $to_branch_id  > 0 ? $to_branch_id  : '-1';
    $from_branch_id = $from_branch_id  > 0 ? $from_branch_id  : '-1';
    $branch = array();
    $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id in ($to_branch_id,$from_branch_id)");
    while($row = $branches->fetch_assoc()):
        $branch[$row['id']] = $row['address'];
    endwhile;
} 
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info">
                    <dl>
                        <dt>Tracking Number:</dt>
                        <dd> <h4><b><?php echo $reference_number ?></b></h4></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="callout callout-info">
                    <b class="border-bottom border-primary">Sender Information</b>
                    <dl>
                        <dt>Name:</dt>
                        <dd><?php echo ucwords($sender_name) ?></dd>
                        <dt>Address:</dt>
                        <dd><?php echo ucwords($sender_address) ?></dd>
                        <dt>Contact:</dt>
                        <dd><?php echo ucwords($sender_contact) ?></dd>
                    </dl>
                </div>
                <div class="callout callout-info">
                    <b class="border-bottom border-primary">Recipient Information</b>
                    <dl>
                        <dt>Name:</dt>
                        <dd><?php echo ucwords($recipient_name) ?></dd>
                        <dt>Address:</dt>
                        <dd><?php echo ucwords($recipient_address) ?></dd>
                        <dt>Contact:</dt>
                        <dd><?php echo ucwords($recipient_contact) ?></dd>
                    </dl>
                </div>
            </div>
            <div class="col-md-6">
                <div class="callout callout-info">
                    <b class="border-bottom border-primary">Parcel Details</b>
                    <div class="row">
                        <div class="col-sm-6">
                            <dl>
                                <dt>Weight:</dt>
                                <dd><?php echo $weight ?></dd>
                                <dt>Height:</dt>
                                <dd><?php echo $height ?></dd>
                                <dt>Price:</dt>
                                <dd><?php echo number_format($price,2) ?></dd>
                            </dl>    
                        </div>
                        <div class="col-sm-6">
                            <dl>
                                <dt>Width:</dt>
                                <dd><?php echo $width ?></dd>
                                <dt>Length:</dt>
                                <dd><?php echo $length ?></dd>
                                <dt>Type:</dt>
                                <dd><?php echo $type == 1 ? "<span class='badge badge-primary'>Deliver to Recipient</span>":"<span class='badge badge-info'>Pickup</span>" ?></dd>
                            </dl>    
                        </div>
                    </div>
                    <dl>
                        <dt>Branch Accepted the Parcel:</dt>
                        <dd><?php echo ucwords($branch[$from_branch_id]) ?></dd>
                        <?php if($type == 2): ?>
                            <dt>Nearest Branch to Recipient for Pickup:</dt>
                            <dd><?php echo ucwords($branch[$to_branch_id]) ?></dd>
                        <?php endif; ?>
                        <dt>Status:</dt>
                        <dd>
                            <?php 
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
                            echo "<span class='badge badge-pill badge-info'>" . $status_arr[$status] . "</span>";
                            ?>
                            <a href="update_status.php?id=<?php echo $id; ?>&cs=<?php echo $status; ?>"><button class="btn badge badge-primary bg-gradient-primary" type="button">Update Status</button></a>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="parcelDetailsModal" tabindex="-1" role="dialog" aria-labelledby="parcelDetailsModalLabel" aria-hidden="true">
    <!-- Modal content goes here -->
</div>

<noscript>
    <style>
        table.table{
            width:100%;
            border-collapse: collapse;
        }
        table.table tr,table.table th, table.table td{
            border:1px solid;
        }
        .text-cnter{
            text-align: center;
        }
    </style>
</noscript>

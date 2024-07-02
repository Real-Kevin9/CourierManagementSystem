<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Tracking</title>
    <link rel="stylesheet" href="styles/track.css">
</head>
<body>
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                    <label for="">Enter Tracking Number</label>
                    <div class="input-group col-sm-5">
                        <input type="search" id="ref_no" class="form-control form-control-sm" placeholder="Type the tracking number here">
                        <div class="input-group-append">
                            <button type="button" id="track-btn" class="btn btn-sm btn-primary btn-gradient-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="timeline" id="parcel_history">
                    
                </div>
            </div>
        </div>
    </div>

    <div id="clone_timeline-item" class="d-none">
        <div class="iitem">
            <span class="bg"></span>
            <div class="timeline-item">
                <span class="time"> <span class="dtime">12:05</span></span>
                <div class="timeline-body">
                    asdasd
                </div>
            </div>
        </div>
    </div>

    <script src="scripts/track.js"></script>
    <script>
        function track_now() {
            var tracking_num = document.getElementById('ref_no').value;
            if (tracking_num == '') {
                document.getElementById('parcel_history').innerHTML = '';
            } else {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'ajax.php?action=get_parcel_history', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var resp = xhr.responseText;
                        if (resp !== '') {
                            var data = JSON.parse(resp);
                            if (Object.keys(data).length > 0) {
                                document.getElementById('parcel_history').innerHTML = '';
                                Object.keys(data).map(function(k) {
                                    var tl = document.getElementById('clone_timeline-item').cloneNode(true);
                                    tl.classList.remove('d-none');
                                    tl.querySelector('.dtime').textContent = data[k].date_created;
                                    tl.querySelector('.timeline-body').textContent = statusMapping[data[k].status] || "Unknown Status";
                                    document.getElementById('parcel_history').appendChild(tl);
                                });
                            }
                        } else {
                            alert('Unknown Tracking Number.');
                        }
                    }
                };
                xhr.send('ref_no=' + tracking_num);
            }
        }

        document.getElementById('track-btn').addEventListener('click', function() {
            track_now();
        });

        document.getElementById('ref_no').addEventListener('search', function() {
            track_now();
        });

        var statusMapping = {
            0: "Item Accepted by Courier",
            1: "Collected",
            2: "Shipped",
            3: "In-Transit",
            4: "Arrived At Destination",
            5: "Out for Delivery",
            6: "Ready to Pickup",
            7: "Delivered",
            8: "Picked-up",
            9: "Unsuccessful Delivery Attempt"
        };
    </script>
</body>
</html>

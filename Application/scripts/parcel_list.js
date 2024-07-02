document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.view_parcel').forEach(function(item) {
        item.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            fetch('view_parcel.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    // Update the HTML content with the parcel details
                    document.getElementById('parcelDetails').innerHTML = data;
                    // Show the modal
                    document.getElementById('parcelDetailsModal').classList.add('show');
                    document.getElementById('parcelDetailsModal').style.display = 'block';
                    document.body.classList.add('modal-open');
                })
                .catch(error => {
                    console.error('Error fetching parcel details:', error);
                });
        });
    });

    document.querySelectorAll('.delete_parcel').forEach(function(button) {
        button.addEventListener('click', function() {
            if(confirm("Are you sure to delete this parcel?")){
                delete_parcel(this.dataset.id);
            }
        });
    });

    $('#list').DataTable();
});

function delete_parcel(id) {
    fetch('ajax.php?action=delete_parcel', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({id: id})
    })
    .then(response => response.text())
    .then(resp => {
        if (resp == 1) {
            alert_toast("Data successfully deleted");
            setTimeout(function() {
                location.reload();
            }, 1500);
        }
    })
}

function closeModal() {
    document.getElementById('parcelDetailsModal').classList.remove('show');
    document.getElementById('parcelDetailsModal').style.display = 'none';
    document.body.classList.remove('modal-open');
}
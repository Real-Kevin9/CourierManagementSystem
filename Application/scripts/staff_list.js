document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete_staff').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm("Are you sure to delete this staff?")) {
                delete_staff(this.dataset.id);
            }
        });
    });
});

function delete_staff(id) {
    fetch('ajax.php?action=delete_staff', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ id: id })
    })
    .then(response => response.text())
    .then(resp => {
        if (resp == 1) {
            alert("Data successfully deleted");
            setTimeout(function() {
                location.reload();
            }, 1500);
        }
    });
}

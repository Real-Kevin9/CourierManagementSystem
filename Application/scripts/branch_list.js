document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete_branch').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm("Are you sure to delete this branch?")) {
                delete_branch(this.dataset.id);
            }
        });
    });
});

function delete_branch(id) {
    fetch('ajax.php?action=delete_branch', {
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
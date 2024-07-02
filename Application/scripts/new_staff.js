document.getElementById('manage-staff').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('ajax.php?action=save_user', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if(response == "1") {
            alert('Data successfully saved');
            location.href = 'index.php?page=staff_list';
        } else if(response == "2") {
            document.getElementById('msg').innerHTML = '<div class="alert alert-danger"> Email already exists.</div>';
        }
    })
    .catch(error => {
        console.error(error);
        alert('An error occurred.');
    });
});
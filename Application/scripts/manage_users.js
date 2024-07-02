document.getElementById('manage-user').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    
    fetch('ajax.php?action=save_user', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if(response == "1") {
            alert("Data successfully saved");
                location.reload();
        } else {
            document.getElementById('msg').innerHTML = '<div class="alert alert-danger">Username already exists</div>';
        }
    })
    .catch(error => {
        console.error(error);
    });

});
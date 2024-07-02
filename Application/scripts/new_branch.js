document.getElementById('manage-branch').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('ajax.php?action=save_branch', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if(response.trim() == "1") {
          alert('Data successfully saved');
            location.href = 'index.php?page=branch_list';
        }
    })
    .catch(error => {
        console.error(error);
        alert('An error occurred.');
    });
  });
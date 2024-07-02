document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login-form').addEventListener('submit', function(e) {
      e.preventDefault();
      let alertDanger = this.querySelector('.alert-danger');
      if (alertDanger) {
        alertDanger.remove();
      }
      fetch('ajax.php?action=login', {
        method: 'POST',
        body: new FormData(this),
      })
      .then(response => response.text())
      .then(resp => {
        if (resp == 1) {
          location.href = 'index.php?page=home';
        } else {
          let alert = document.createElement('div');
          alert.className = 'alert alert-danger';
          alert.textContent = 'Username or password is incorrect.';
          this.prepend(alert);
        }
      })
      .catch(err => {
        console.error(err);
      });
    });
  });
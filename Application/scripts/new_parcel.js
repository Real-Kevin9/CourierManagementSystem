document.getElementById('dtype').addEventListener('change', function() {
    if(this.checked) {
      document.getElementById('tbi-field').style.display = 'none';
    } else {
      document.getElementById('tbi-field').style.display = 'block';
    }
  });

  document.querySelectorAll('[name="price[]"]').forEach(function(input) {
    input.addEventListener('keyup', calc);
  });

  document.getElementById('new_parcel').addEventListener('click', function() {
    var ptrClone = document.getElementById('ptr_clone');
    var tr = ptrClone.querySelector('tr').cloneNode(true);
    document.getElementById('parcel-items').querySelector('tbody').appendChild(tr);
    tr.querySelectorAll('[name="price[]"]').forEach(function(input) {
      input.addEventListener('keyup', calc);
    });
    tr.querySelectorAll('.number').forEach(function(input) {
      input.addEventListener('input', function() {
        var val = this.value;
        val = val.replace(/[^0-9]/g, '');
        val = val ? parseFloat(val).toLocaleString('en-US') : 0;
        this.value = val;
      });
    });
  });

  document.getElementById('manage-parcel').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    if(document.querySelectorAll('#parcel-items tbody tr').length <= 0) {
      alert('Please add at least 1 parcel information.');
      return false;
    }

    fetch('ajax.php?action=save_parcel', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(response => {
      if(response == 1) {
        alert('Data successfully saved');
        location.href = 'index.php?page=parcel_list';
      } else {
        console.error(response);
        alert('An error occurred.');
      }
    })
    .catch(error => {
      console.error(error);
      alert('An error occurred.');
    });
  });

  function removeRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    calc();
  }

  function calc() {
    var total = 0;
    document.querySelectorAll('#parcel-items [name="price[]"]').forEach(function(input) {
      var val = input.value.replace(/,/g, '');
      total += parseFloat(val) || 0;
    });

    var tAmount = document.getElementById('tAmount');
    if(tAmount) {
      tAmount.textContent = total.toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 });
    }
  }

  document.querySelectorAll('.number').forEach(function(input) {
    input.addEventListener('input', function() {
      var val = this.value.replace(/[^0-9]/g, '');
      this.value = val ? parseFloat(val).toLocaleString('en-US') : 0;
    });
  });
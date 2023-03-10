document.addEventListener('DOMContentLoaded', function() {

  var entryForm = document.getElementById('entryForm');
  var parkingTable = document.getElementById('parkingTable');

  entryForm.addEventListener('submit', function(event) {
    event.preventDefault();

    var name = document.getElementById('name').value;
    var parking = document.getElementById('parking').value;
    var licensePlate = document.getElementById('licensePlate').value;
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;

    if (name === '' || parking === '' || licensePlate === '' || startDate === '' || endDate === ''){
      alert('Please FIll out the Form completly');
      return
    }
    
    var regex = /^[a-zA-Z0-9@#%&!?'"$£€¥₹()\-\s]+$/;

    if (!regex.test(name) || !regex.test(parking) || !regex.test(licensePlate)) {
      alert('No Regex');
      return;
    }


    var xhr = new XMLHttpRequest();

    xhr.open('POST', './backend/add_parking.php');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('load', function() {
      if (xhr.status === 200) {

        var data = JSON.parse(xhr.responseText);
        var row = parkingTable.insertRow();
        var nameCell = row.insertCell();
        var parkingCell = row.insertCell();
        var licensePlateCell = row.insertCell();
        var startDateCell = row.insertCell();
        var endDateCell = row.insertCell();
        nameCell.textContent = data.name;
        parkingCell.textContent = data.parking;
        licensePlateCell.textContent = data.licensePlate;
        startDateCell.textContent = data.startDate;
        endDateCell.textContent = data.endDate;
      } else {
        console.log('Error: ' + xhr.statusText);
      }
    });

    var formData = 'name=' + encodeURIComponent(name) +
                   '&parking=' + encodeURIComponent(parking) +
                   '&licensePlate=' + encodeURIComponent(licensePlate) +
                   '&startDate=' + encodeURIComponent(startDate) +
                   '&endDate=' + encodeURIComponent(endDate);
    xhr.send(formData);
  });
});

function refreshData(){
$.ajax({
  type: "GET",
  url: "./backend/backend-script.php",
  dataType: "json",
  success: function(data) {
    var tbody = document.querySelector('#parkingLotTable');
    tbody.innerText = '';

    data.forEach(function(row) {
      var newRow = '<tr>' +
        '<td>' + row.name + '</td>' +
        '<td>' + row.parking + '</td>' +
        '<td>' + row.licensePlate + '</td>' +
        '<td>' + row.startDate + '</td>' +
        '<td>' + row.endDate + '</td>' +
        '</tr>';
      tbody.innerHTML += newRow;

    });
  },
  error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
  }
});
}

refreshData();

setInterval(refreshData, 1000);


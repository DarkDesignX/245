document.addEventListener('DOMContentLoaded', function() {

  var entryForm = document.getElementById('entryForm');
  var parkingTable = document.getElementById('parkingTable');

  entryForm.addEventListener('submit', function(event) {
    event.preventDefault();

    var name = document.getElementById('name').value;
    var room = document.getElementById('room').value;
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;

    if (name === '' || room === '' || startDate === '' || endDate === ''){
      alert('Please FIll out the Form completely');
      return
    }
    
    var regex = /^[a-zA-Z0-9@#%&!?'"$£€¥₹()\-\s]+$/;

    if (!regex.test(name) || !regex.test(room)) {
      alert('No Regex');
      return;
    }


    var xhr = new XMLHttpRequest();

    xhr.open('POST', './backend/add_room.php');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('load', function() {
      if (xhr.status === 200) {

        var data = JSON.parse(xhr.responseText);
        var row = parkingTable.insertRow();
        var nameCell = row.insertCell();
        var roomCell = row.insertCell();
        var startDateCell = row.insertCell();
        var endDateCell = row.insertCell();
        idCell.textContent = data.id;
        nameCell.textContent = data.owner;
        roomCell.textContent = data.car;
        roomnumberCell.textContent = data.roomnumber;
        startDateCell.textContent = data.startDate;
        endDateCell.textContent = data.endDate;
      } else {
        console.log('Error: ' + xhr.statusText);
      }
    });

    var formData = 'name=' + encodeURIComponent(name) +
                   '&room=' + encodeURIComponent(room) +
                   '&startDate=' + encodeURIComponent(startDate) +
                   '&endDate=' + encodeURIComponent(endDate);
    xhr.send(formData);
  });
});
function deleteRoom(id) {
  var xhr = new XMLHttpRequest();

  xhr.open('GET', './backend/delete_room.php?id=' + encodeURIComponent(id));
  xhr.addEventListener('load', function() {
    if (xhr.status === 200) {
      window.confirm('Room deleted successfully!');
      refreshData();
    } else {
      console.log('Error: ' + xhr.statusText);
    }
  });  

  xhr.send();
}
function refreshData(){
$.ajax({
  type: "GET",
  url: "./backend/backend-script_room.php",
  dataType: "json",
  success: function(data) {
    var tbody = document.querySelector('#parkingLotTable');
    tbody.innerText = '';

    data.forEach(function(row) {
      var newRow = '<tr>' +
        '<td>' + row.id + '</td>' +
        '<td>' + row.Name + '</td>' +
        '<td>' + row.Room + '</td>' +
        '<td>' + row.startDate + '</td>' +
        '<td>' + row.endDate + '</td>' +
        '<td><button data-id="' + row.id + '" class="deleteBtn">Delete</button></td>' +
        '</tr>';
      tbody.innerHTML += newRow;

    });
    var deleteBtns = document.querySelectorAll('.deleteBtn');
    deleteBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        deleteRoom(id);
      });
    });
  },
  error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
  }
});
}

refreshData();

setInterval(refreshData, 1000);

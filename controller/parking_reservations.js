//create variable
var loadParkingReservationsCallback = null;
//create variable get parking-reservation table by id
var parkingReservationTable = document.getElementById("parking-reservations-table");

//create variable
var parking_reservations = [ ];

//function to load parking reservation
function loadParkingReservation(callback = null) {
	loadParkingReservationsCallback = callback;

	sendRequest("GET", "API/v1/AllParkingReservations", onParkingReservationsLoaded, onParkingReservationsLoadingError);
}

function onParkingReservationsLoaded(request) {
	if (request.getResponseHeader('Content-Type').indexOf('application/json') !== -1) {
		parking_reservations = JSON.parse(request.responseText);
	} else {
		alert('Invalid response content type: ' + request.getResponseHeader('Content-Type'));
	}
	if (loadParkingReservationsCallback) {
		loadParkingReservationsCallback();
	}
}

//error by load parking reservation
function onParkingReservationsLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the parking reservations because of the follwoing error:\r\n\r\n" +  request.responseText);
	}
}

//function to load the list of parking reservations
function loadParkingReservationList() {
	loadParkingReservation(onParkingReservationsLoadedForList);
}

function onParkingReservationsLoadedForList() {
	parkingReservationTable.innerHTML = "";

	for (var i = 0; i < parking_reservations.length; i++) {
		var parkingRow = document.createElement("tr");
		parkingReservationTable.appendChild(parkingRow);

		var parkingNumberCell = document.createElement("td");
		parkingNumberCell.innerText = parking_reservations[i].parking_number;
		parkingRow.appendChild(parkingNumberCell);

		var userNameCell = document.createElement("td");
		userNameCell.innerText = parking_reservations[i].name;
		parkingRow.appendChild(userNameCell);

		var timeStartCell = document.createElement("td");
		timeStartCell.innerText = parking_reservations[i].time_start;
		parkingRow.appendChild(timeStartCell);

		var timeEndCell = document.createElement("td");
		timeEndCell.innerText = parking_reservations[i].time_end;
		parkingRow.appendChild(timeEndCell);

		var actionsCell = document.createElement("td");
		parkingRow.appendChild(actionsCell);

		var deleteButton = document.createElement("button");
		deleteButton.innerText = "Delete";
		deleteButton.onclick = onDeleteButtonPressed;
		deleteButton.className = "destructive";
		deleteButton.setAttribute("parking-id", parking_reservations[i].parking_reservation_id);
		actionsCell.appendChild(deleteButton);

		var editButton = document.createElement("a");
		editButton.innerText = "Edit";
		editButton.className = "button";
		editButton.href = "parking_reservation.php?id=" + parking_reservations[i].parking_reservation_id;
		actionsCell.appendChild(editButton);
	}
}
//function to pressing the delete button
function onDeleteButtonPressed(event) {
	var id = event.currentTarget.getAttribute("parking-id");
	if (!confirm("Are you sure that you want to delete the parking reservation with the parking number " + id + "?")) {
		return;
	}

	sendRequest("DELETE", "API/v1/ParkingReservation/" + id, onParkingReservationDeleted, onParkingReservationDeletionError);
}

//load parking reservations after the deleting of a reservation
function onParkingReservationDeleted(request) {
	loadParkingReservationList();
}
 
//error by deleting the parking reservation
function onParkingReservationDeletionError(request) {
	alert("the parking reservation could not be deleted. Please try again!")
}
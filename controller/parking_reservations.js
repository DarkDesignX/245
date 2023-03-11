var loadParkingReservationsCallback = null;
var parkingReservationTable = document.getElementById("parking-reservations-table");

var parking_reservations = [ ];

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

function onParkingReservationsLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the parking reservations because of the follwoing error:\r\n\r\n" +  request.responseText);
	}
}

function loadParkingReservationList() {
	loadParkingReservation(onParkingReservationsLoadedForList);
}

function onParkingReservationsLoadedForList() {
	parkingReservationTable.innerHTML = "";

	for (var i = 0; i < parking_reservations.length; i++) {
		var parkingRow = document.createElement("tr");
		parkingReservationTable.appendChild(parkingRow);

		var parkingReservationCell = document.createElement("td");
		parkingReservationCell.innerText = parking_reservations[i].parking_reservation;
		parkingRow.appendChild(parkingReservationCell);

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

		// var actionsCell = document.createElement("td");
		// parkingRow.appendChild(actionsCell);

		// var deleteButton = document.createElement("button");
		// deleteButton.innerText = "Delete";
		// deleteButton.onclick = onDeleteButtonPressed;
		// deleteButton.className = "destructive";
		// deleteButton.setAttribute("parking-id", parking_reservations[i].parking_reservation_id);
		// actionsCell.appendChild(deleteButton);

		// var editButton = document.createElement("a");
		// editButton.innerText = "Edit";
		// editButton.className = "button";
		// editButton.href = "parking_reservation.php?id=" + parking_reservations[i].parking_reservation_id;
		// actionsCell.appendChild(editButton);
	}
}

// function onDeleteButtonPressed(event) {
// 	var id = event.currentTarget.getAttribute("parking-id");
// 	if (!confirm("Are you sure that you want to delete the parking reservation with the parking number " + id + "?")) {
// 		return;
// 	}

// 	sendRequest("DELETE", "API/v1/ParkingReservation/" + id, onParkingReservationDeleted, onParkingReservationDeletionError);
// }

// function onParkingReservationDeleted(request) {
// 	loadParkingReservationList();
// }

// function onParkingReservationDeletionError(request) {
// 	alert("the parking reservation could not be deleted. Please try again!")
// }
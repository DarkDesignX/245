var loadParkingReservationsCallback = null;
var parkingsTable = document.getElementById("parking-reservations-table");

var parking_reservations = [ ];

function loadParkingReservations(callback = null) {
	loadParingReservationsCallback = callback;

	sendRequest("GET", "API/V1/AllParkingReservations", onParkingReservationsLoaded, onParkingReservationLoadingError);
}

function onParkingReservationsLoaded(request) {
	parking_reservations = JSON.parse(request.responseText);

	if (loadParkingReservationsCallback){
		loadParkingReservationsCallback();
	}
}

function onParkingReservationLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the parking reservations because of the follwoing error:\r\n\r\n" +  request.responseText);
	}
}

function loadParkingReservationList() {
	loadParkingReservations(onParkingReservationsLoadedForList);
}

function onParkingReservationsLoadedForList(request) {
	parkingsTable.innerHTML = "";

	var parkings = JSON.parse(request.responseText);

	for (var i = 0; i < parkings.length; i++) {
		var parkingRow = document.createElement("tr");
		parkingsTable.appendChild(parkingRow);

		var parkingNumberCell = document.createElement("td");
		parkingNumberCell.innerText = parkings[i].parking_number;
		parkingRow.appendChild(parkingNumberCell);

		var userNameCell = document.createElement("td");
		userNameCell.innerText = parkings[i].name;
		parkingRow.appendChild(userNameCell);

		var timeStartCell = document.createElement("td");
		timeStartCell.innerText = parkings[i].time_start;
		parkingRow.appendChild(timeStartCell);

		var timeEndCell = document.createElement("td");
		timeEndCell.innerText = parkings[i].time_end;
		parkingRow.appendChild(timeEndCell);

		var actionsCell = document.createElement("td");
		parkingRow.appendChild(actionsCell);

		var deleteButton = document.createElement("button");
		deleteButton.innerText = "Delete";
		deleteButton.onclick = onDeleteButtonPressed;
		deleteButton.className = "destructive";
		deleteButton.setAttribute("parking-number", parkings[i].parking_number);
		actionsCell.appendChild(deleteButton);

		var editButton = document.createElement("a");
		editButton.innerText = "Edit";
		editButton.className = "button";
		editButton.href = "parking_reservation.php?parking_number=" + parkings[i].parking_number;
		actionsCell.appendChild(editButton);
	}
}

function onParkingsLoadingError(request) {
	if (request.status == 401) {
		return;
	}

	alert("Error: " + request.statusText);
}

function onDeleteButtonPressed(event) {
	var id = event.currentTarget.getAttribute("parking-number");
	if (!confirm("Are you sure that you want to delete the parking reservation with the parking number " + id + "?")) {
		return;
	}

	sendRequest("DELETE", "API/v1/ParkingReservation/" + id, onParkingDeleted, onParkingDeletionError);
}

function onParkingReservationDeleted(request) {
	loadParkingReservationList();
}

function onParkingReservationDeletionError(request) {
	alert("the parking reservation could not be deleted. Please try again!")
}
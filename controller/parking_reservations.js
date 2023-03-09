var parkingsTable = document.getElementById("parking-reservations-table");

function onParkingsLoaded(request) {
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
		editButton.href = "reservations.php?parking_number=" + parkings[i].parking_number;
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

function onParkingDeleted(request) {
	refreshParkings();
}

function onParkingDeletionError(request) {
	alert("The parking reservation could not be deleted. Please try again!");
}

function refreshParkings() {
	sendRequest("GET", "API/v1/AllParkingReservations", onParkingsLoaded, onParkingsLoadingError);
}

refreshParkings();
var loadRoomReservationsCallback = null;
var roomReservationTable = document.getElementById("room-reservations-table");

var room_reservations = [ ];

function loadRoomReservation(callback = null) {
	loadRoomReservationsCallback = callback;

	sendRequest("GET", "API/v1/AllRoomReservations", onRoomReservationsLoaded, onRoomReservationsLoadingError);
}

function onRoomReservationsLoaded(request) {
	if (request.getResponseHeader('Content-Type').indexOf('application/json') !== -1) {
		room_reservations = JSON.parse(request.responseText);
	} else {
		alert('Invalid response content type: ' + request.getResponseHeader('Content-Type'));
	}
	if (loadRoomReservationsCallback) {
		loadRoomReservationsCallback();
	}
}

function onRoomReservationsLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the room reservations because of the follwoing error:\r\n\r\n" +  request.responseText);
	}
}

function loadRoomReservationList() {
	loadRoomReservation(onRoomReservationsLoadedForList);
}

function onRoomReservationsLoadedForList(request) {
	roomReservationTable.innerHTML = "";

	for (var i = 0; i < room_reservations.length; i++) {
		var roomRow = document.createElement("tr");
		roomReservationTable.appendChild(roomRow);

		var roomNameCell = document.createElement("td");
		roomNameCell.innerText = room_reservations[i].room_name;
		roomRow.appendChild(roomNameCell);

		var userNameCell = document.createElement("td");
		userNameCell.innerText = room_reservations[i].name;
		roomRow.appendChild(userNameCell);

		var timeStartCell = document.createElement("td");
		timeStartCell.innerText = room_reservations[i].time_start;
		roomRow.appendChild(timeStartCell);

		var timeEndCell = document.createElement("td");
		timeEndCell.innerText = room_reservations[i].time_end;
		roomRow.appendChild(timeEndCell);

		var actionsCell = document.createElement("td");
		roomRow.appendChild(actionsCell);

		var deleteButton = document.createElement("button");
		deleteButton.innerText = "Delete";
		deleteButton.onclick = onDeleteButtonPressed;
		deleteButton.className = "destructive";
		deleteButton.setAttribute("room-id", room_reservations[i].room_reservation_id);
		actionsCell.appendChild(deleteButton);

		var editButton = document.createElement("a");
		editButton.innerText = "Edit";
		editButton.className = "button";
		editButton.href = "room_reservation.php?id=" + room_reservations[i].room_reservation_id;
		actionsCell.appendChild(editButton);
	}
}

function onRoomReservationsLoadingError(request) {
	if (request.status == 401) {
		return;
	}

	alert("Error: " + request.statusText);
}

function onDeleteButtonPressed(event) {
	var id = event.currentTarget.getAttribute("room-id");
	if (!confirm("Are you sure that you want to delete the room reservation with the room id " + id + "?")) {
		return;
	}

	sendRequest("DELETE", "API/v1/RoomReservation/" + id, onRoomReservationDeleted, onRoomReservationDeletionError);
}

function onRoomReservationDeleted(request) {
	loadRoomReservationList();
}

function onRoomReservationDeletionError(request) {
	alert("the room reservation could not be deleted. Please try again!")
}
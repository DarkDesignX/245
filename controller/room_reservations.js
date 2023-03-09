//needs fixing

var loadRoomReservationsCallback = null;
var roomsTable = document.getElementById("room-reservations-table");

var rooms = [ ];

function loadRoomReservations(callback = null) {
	loadRoomReservationsCallback = callback;

	sendRequest("GET", "API/V1/RoomReservations", onRoomReservationsLoaded, onRoomReservationsLoadingError);
}

function onRoomReservationsLoaded(request) {
	rooms = JSON.parse(request.responseText);

	if (loadRoomReservationsCallback) {
		loadRoomReservationsCallback();
	}
}

function onRoomReservationsLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the room reservation because of the following error:\r\n\r\n" + request.responseText);
	}
}

function loadRoomReservationList() {
	loadRoomReservations(onRoomReservationsLoadedForList);
}

function onRoomReservationsLoadedForList() {
	roomsTable.innerHTML = "";

	for (var i = 0; i < rooms.length; i++) {
		var roomReservationRow = document.createElement("tr");
		roomsTable.appendChild(roomRow);

		var roomNameCell = document.createElement("td");
		roomNameCell.innerText = rooms[i].room_name;
		roomReservationRow.appendChild(roomNameCell);

		var userNameCell = document.createElement("td");
		userNameCell.innerText = rooms[i].name;
		roomRow.appendChild(userNameCell);

		var timeStartCell = document.createElement("td");
		timeStartCell.innerText = rooms[i].time_start;
		roomRow.appendChild(timeStartCell);

		var timeEndCell = document.createElement("td");
		timeEndCell.innerText = rooms[i].time_end;
		roomRow.appendChild(timeEndCell);

		var actionsCell = document.createElement("td");
		roomReservationRow.appendChild(actionsCell);

		var deleteButton = document.createElement("button");
		deleteButton.innerText = "Delete";
		deleteButton.onclick = onDeleteButtonPressed;
		deleteButton.className = "destructive";
		deleteButton.setAttribute("roomReservation-id", rooms[i].room_id);
		actionsCell.appendChild(deleteButton);

		var editButton = document.createElement("a");
		editButton.innerText = "Edit";
		editButton.className = "button";
		editButton.href = "reservations.php?id=" + rooms[i].room_id;
		actionsCell.appendChild(editButton);
	}
}

function onDeleteButtonPressed(event) {
	var id = event.currentTarget.getAttribute("roomReservation-id");
	if (!confirm("Are you sure that you want to delete the room reservation with the ID " + id + "?")) {
		return;
	}

	sendRequest("DELETE", "API/V1/RoomReservation/" + id, onRoomReservationDeleted, onRoomReservationDeletionError);
}

function onRoomReservationDeleted(request) {
	loadRoomReservationList();
}

function onRoomReservationDeletionError(request) {
	alert("The room reservation could not be deleted. Please try again!");
}
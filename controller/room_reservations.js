var loadRoomReservationsCallback = null;
var roomsTable = document.getElementById("room-reservations-table");

var room_reservations = [ ];

function loadRoomReservations(callback = null) {
	loadParingReservationsCallback = callback;

	sendRequest("GET", "API/V1/AllRoomReservations", onRoomReservationsLoaded, onRoomReservationLoadingError);
}

function onRoomReservationsLoaded(request) {
	room_reservations = JSON.parse(request.responseText);

	if (loadRoomReservationsCallback){
		loadRoomReservationsCallback();
	}
}

function onRoomReservationLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the room reservations because of the follwoing error:\r\n\r\n" +  request.responseText);
	}
}

function loadRoomReservationList() {
	loadRoomReservations(onRoomReservationsLoadedForList);
}

function onRoomReservationsLoadedForList(request) {
	roomsTable.innerHTML = "";

	var rooms = JSON.parse(request.responseText);

	for (var i = 0; i < rooms.length; i++) {
		var roomRow = document.createElement("tr");
		roomsTable.appendChild(roomRow);

		var roomNameCell = document.createElement("td");
		roomNameCell.innerText = rooms[i].room_name;
		roomRow.appendChild(roomNameCell);

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
		roomRow.appendChild(actionsCell);

		var deleteButton = document.createElement("button");
		deleteButton.innerText = "Delete";
		deleteButton.onclick = onDeleteButtonPressed;
		deleteButton.className = "destructive";
		deleteButton.setAttribute("room-name", rooms[i].room_name);
		actionsCell.appendChild(deleteButton);

		var editButton = document.createElement("a");
		editButton.innerText = "Edit";
		editButton.className = "button";
		editButton.href = "room_reservation.php?room_name=" + rooms[i].room_name;
		actionsCell.appendChild(editButton);
	}
}

function onRoomsLoadingError(request) {
	if (request.status == 401) {
		return;
	}

	alert("Error: " + request.statusText);
}

function onDeleteButtonPressed(event) {
	var id = event.currentTarget.getAttribute("room-name");
	if (!confirm("Are you sure that you want to delete the room reservation with the room name " + id + "?")) {
		return;
	}

	sendRequest("DELETE", "API/v1/RoomReservation/" + id, onRoomDeleted, onRoomDeletionError);
}

function onRoomReservationDeleted(request) {
	loadRoomReservationList();
}

function onRoomReservationDeletionError(request) {
	alert("the room reservation could not be deleted. Please try again!")
}
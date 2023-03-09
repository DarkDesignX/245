//nees fixing

var room_reservation_id = null;

var userNameField = document.getElementById("name-field");
var startTimeField = document.getElementById("start-time-field");
var endTimeField = document.getElementById("end-time-field");
var commentField = document.getElementById("comment-field");
var roomNameSelect = document.getElementById("room-name-select");

function onEditRoomReservationFormSubmitted(event) {
	event.preventDefault();

	var room_reservation = {
		name: userNameField.value,
		startTime: startTimeField.value,
		endTime: endTimeField.value,
		comment: commentField.value ? commentField.value : null,
		room_name: roomNameSelect.value
	};

	sendRequest("PUT", "API/v1/RoomReservation/" + roomNameSelect.value, onRoomReservationSaved, onRoomReservationSavingError, room_reservation);
}

function onRoomReservationSaved(request) {
	window.open("room_reservations.php", "_self");
}

function onRoomReservationSavingError(request) {
	if (request) {
		alert("Could not save the room reservation information because of the following error:\r\n\r\n" + request.responseText);
	}
}

function onRoomReservationLoaded(request) {
	var room_reservation = JSON.parse(request.responseText);

	userNameField.value = room_reservation.name;
	startTimeField.value = room_reservation.time_start;
	endTimeField.value = room_reservation.time_end;
	commentField.value = room_reservation.comment ? room_reservation.comment : "";
	roomNameSelect.value = room_reservation.room_name;
}

function onRoomReservationLoadingError(request) {
	if (request) {
		alert("The requested room reservation could not be loaded because of the following error:\r\n\r\n" + request.responseText);
	}
}

//needs fixing
function onRoomsLoadedCallback() {
	for (var i = 0; i < room.length; i++) {
		var roomOption = document.createElement("option");
		roomOption.value = room[i].id;
		roomOption.innerText = room[i].name;
		roomSelect.appendChild(roomOption);
	}

	var searchKeyValuePairs = window.location.search.substring(1).split("&");
	for (var i = 0; i < searchKeyValuePairs.length; i++) {
		var splitted = searchKeyValuePairs[i].split("=");
		if (splitted[0] == "room_reservation_id" && splitted.length > 1) {
			room_reservation_id = splitted[1];
		}
	}

	if (room_reservation_id) {
		sendRequest("GET", "API/v1/RoomReservation/" + room_reservation_id, onRoomReservationLoaded, onRoomReservationLoadingError);

		roomNameSelect.disabled = true;
	}
	else {
		roomNameSelect.disabled = false;
	}
}

loadRooms(onRoomsLoadedCallback);
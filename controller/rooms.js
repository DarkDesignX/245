var loadRoomsCallback = null;
var roomsTable = document.getElementById("room-table");

var rooms = [ ];

function loadRoom(callback = null) {
	loadRoomsCallback = callback;

	sendRequest("GET", "API/V1/Rooms", onRoomsLoaded, onRoomsLoadingError);
}

function onRoomsLoaded(request) {
	rooms = JSON.parse(request.responseText);

	if (loadRoomsCallback) {
		loadRoomsCallback();
	}
}

function onRoomsLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the rooms because of the following error:\r\n\r\n" + request.responseText);
	}
}

function loadRoomList() {
	loadRooms(onRoomsLoadedForList);
}

function onRoomsLoadedForList() {
	roomsTable.innerHTML = "";

	var room = JSON.parse(request.responseText);

	for (var i = 0; i < room.length; i++) {
		var roomRow = document.createElement("tr");
		roomsTable.appendChild(roomRow);

		var roomNameCell = document.createElement("td");
		roomNameCell.innerText = room[i].name;
		roomRow.appendChild(roomNameCell);

		var descriptionCell = document.createElement("td");
		descriptionCell.innerText = room[i].description;
		roomRow.appendChild(descriptionCell);

		var floorCell = document.createElement("td");
		floorCell.innerText = room[i].floor;
		roomRow.appendChild(floorCell);

		var seatsCell = document.createElement("td");
		seatsCell.innerText = room[i].stock;
		roomRow.appendChild(seatsCell);
	}
}
var loadRoomsCallback = null;
var roomsTable = document.getElementById("rooms-table");

var rooms = [ ];

function loadRoom(callback = null) {
	loadRoomsCallback = callback;

	sendRequest("GET", "API/v1/Rooms", onRoomsLoaded, onRoomsLoadingError);
}

function onRoomsLoaded(request) {
	if (request.getResponseHeader('Content-Type').indexOf('application/json') !== -1) {
		rooms = JSON.parse(request.responseText);
	} else {
		alert('Invalid response content type: ' + request.getResponseHeader('Content-Type'));
	}
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
	loadRoom(onRoomsLoadedForList);
}

function onRoomsLoadedForList() {
	roomsTable.innerHTML = "";

	for (var i = 0; i < rooms.length; i++) {
		var roomRow = document.createElement("tr");
		roomsTable.appendChild(roomRow);

		var roomNameCell = document.createElement("td");
		roomNameCell.innerText = rooms[i].name;
		roomRow.appendChild(roomNameCell);

		var descriptionCell = document.createElement("td");
		descriptionCell.innerText = rooms[i].description;
		roomRow.appendChild(descriptionCell);

		var floorCell = document.createElement("td");
		floorCell.innerText = rooms[i].floor;
		roomRow.appendChild(floorCell);

		var seatsCell = document.createElement("td");
		seatsCell.innerText = rooms[i].seats;
		roomRow.appendChild(seatsCell);
	}
}
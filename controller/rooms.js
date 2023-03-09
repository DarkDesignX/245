var roomsTable = document.getElementById("room-table");

function onRoomsLoaded(request) {
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

function onRoomsLoadingError(request) {
	if (request.status == 401) {
		return;
	}

	alert("Error: " + request.statusText);
}

function refreshRooms() {
	sendRequest("GET", "API/V1/Rooms", onRoomsLoaded, onRoomsLoadingError);
}

refreshRooms();
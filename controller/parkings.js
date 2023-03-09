var loadParkingsCallback = null;
var parkingsTable = document.getElementById("parking-table");

var parkings = [ ];

function loadParking(callback = null) {
	loadParkingsCallback = callback;

	sendRequest("GET", "API/V1/Parkings", onParkingsLoaded, onParkingsLoadingError);
}

function onParkingsLoaded(request) {
	parkings = JSON.parse(request.responseText);

	if (loadParkingsCallback) {
		loadParkingsCallback();
	}
}

function onParkingsLoadingError(request) {
	if (request && request.status != 401) {
		alert("Could not load the parkings because of the following error:\r\n\r\n" + request.responseText);
	}
}

function loadParkingList() {
	loadParkings(onParkingsLoadedForList);
}

function onParkingsLoadedForList() {
	parkingsTable.innerHTML = "";

	for (var i = 0; i < parkings.length; i++) {
		var parkingsRow = document.createElement("tr");
		parkingsTable.appendChild(parkingsRow);

		var idCell = document.createElement("td");
		idCell.innerText = parkings[i].id;
		parkingsRow.appendChild(idCell);

		var poisitionCell = document.createElement("td");
		poisitionCell.innerText = parkings[i].position;
		parkingsRow.appendChild(poisitionCell);
	}
}
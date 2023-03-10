var loadParkingsCallback = null;
var parkingsTable = document.getElementById("parkings-table");

var parkings = [ ];

function loadParking(callback = null) {
	loadParkingsCallback = callback;

	sendRequest("GET", "API/v1/Parkings", onParkingsLoaded, onParkingsLoadingError);
}

function onParkingsLoaded(request) {
	if (request.getResponseHeader('Content-Type').indexOf('application/json') !== -1) {
		parkings = JSON.parse(request.responseText);
	} else {
		alert('Invalid response content type: ' + request.getResponseHeader('Content-Type'));
	}
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
	loadParking(onParkingsLoadedForList);
}

function onParkingsLoadedForList() {
	parkingsTable.innerHTML = "";

	for (var i = 0; i < parkings.length; i++) {
		var parkingRow = document.createElement("tr");
		parkingsTable.appendChild(parkingRow);

		var positionCell = document.createElement("td");
		positionCell.innerText = parkings[i].position;
		parkingRow.appendChild(positionCell);
	}
}
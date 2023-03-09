var parkingsTable = document.getElementById("parking-table");

function onParkingsLoaded(request) {
	parkingsTable.innerHTML = "";

	var parking = JSON.parse(request.responseText);

	for (var i = 0; i < parking.length; i++) {
		var parkingRow = document.createElement("tr");
		parkingsTable.appendChild(parkingRow);

		var parkingPositionCell = document.createElement("td");
		parkingPositionCell.innerText = parking[i].position;
		parkingRow.appendChild(parkingPositionCell);
	}
}

function onParkingsLoadingError(request) {
	if (request.status == 401) {
		return;
	}

	alert("Error: " + request.statusText);
}

function refreshParkings() {
	sendRequest("GET", "API/V1/Parkings", onParkingsLoaded, onParkingsLoadingError);
}

refreshParkings();
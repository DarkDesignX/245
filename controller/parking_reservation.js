//create variable
var parking_number = null;

//create variable get parking information by id
var userNameField = document.getElementById("name-field");
var startTimeField = document.getElementById("start-time-field");
var endTimeField = document.getElementById("end-time-field");
var commentField = document.getElementById("comment-field");
var parkingNumberSelect = document.getElementById("parking-number-select");

//function to edit the parking reservations
function onEditParkingReservationFormSubmitted(event) {
	event.preventDefault();

	var parking_reservation = {
		name: userNameField.value,
		startTime: startTimeField.value,
		endTime: endTimeField.value,
		comment: commentField.value ? commentField.value : null,
		parking_number: parkingNumberSelect.value
	};

	sendRequest("PUT", "API/v1/ParkingReservation/" + parkingNumberSelect.value, onParkingReservationSaved, onParkingReservationSavingError, parking_reservation);
}

//parking reservation saved
function onParkingReservationSaved(request) {
	window.open("parking_reservations.php", "_self");
}

//error by saving parking reservation 
function onParkingReservationSavingError(request) {
	if (request) {
		alert("Could not save the parking reservation information because of the following error:\r\n\r\n" + request.responseText);
	}
}

//function to load parking reservation
function onParkingReservationLoaded(request) {
	var parking_reservation = JSON.parse(request.responseText);

	userNameField.value = parking_reservation.name;
	startTimeField.value = parking_reservation.time_start;
	endTimeField.value = parking_reservation.time_end;
	commentField.value = parking_reservation.comment ? parking_reservation.comment : "";
	parkingNumberSelect.value = parking_reservation.parking_number;
}

//error by load parking reservation
function onParkingReservationLoadingError(request) {
	if (request) {
		alert("The requested parking reservation could not be loaded because of the following error:\r\n\r\n" + request.responseText);
	}
}

function onParkingsLoadedCallback() {
	for (var i = 0; i < parkings.length; i++) {
		var parkingOption = document.createElement("option");
		parkingOption.value = parkings[i].id;
		parkingOption.innerText = parkings[i].position;
		parkingSelect.appendChild(parkingOption);
	}

	var searchKeyValuePairs = window.location.search.substring(1).split("&");
	for (var i = 0; i < searchKeyValuePairs.length; i++) {
		var splitted = searchKeyValuePairs[i].split("=");
		if (splitted[0] == "parking_number" && splitted.length > 1) {
			parking_number = splitted[1];
		}
	}

	if (parking_number) {
		sendRequest("GET", "API/v1/ParkingReservation/" + parking_number, onParkingReservationLoaded, onParkingReservationLoadingError);

		parkingNumberSelect.disabled = true;
	}
	else {
		parkingNumberSelect.disabled = false;
	}
}

loadParkings(onParkingsLoadedCallback);
var sku = null;

var reservationField = document.getElementById("parking-reservation-field");
var userNameField = document.getElementById("name-field");
var startTimeField = document.getElementById("start-time-field");
var endTimeField = document.getElementById("end-time-field");
var commentField = document.getElementById("comment-field");
var parkingNumberSelect = document.getElementById("parking-number-select");

function onEditParkingReservationFormSubmitted(event) {
	event.preventDefault();

	var parking_reservation = {
		reservation: reservationField.value,
		name: userNameField.value,
		startTime: startTimeField.value,
		endTime: endTimeField.value,
		comment: commentField.value ? commentField.value : null,
		parking_number: parkingNumberSelect.value
	};

	sendRequest("PUT", "API/v1/ParkingReservation/" + parkingNumberSelect.value, onParkingReservationSaved, onParkingReservationSavingError, parking_reservation);
}

function onParkingReservationSaved(request) {
	window.open("parking_reservations.php", "_self");
}

function onParkingReservationSavingError(request) {
	if (request) {
		alert("Could not save the parking reservation information because of the following error:\r\n\r\n" + request.responseText);
	}
}

function onParkingReservationLoaded(request) {
	var parking_reservation = JSON.parse(request.responseText);

	reservationField.value = parking_reservation.room_reservation,
	userNameField.value = parking_reservation.name;
	startTimeField.value = parking_reservation.time_start;
	endTimeField.value = parking_reservation.time_end;
	commentField.value = parking_reservation.comment ? parking_reservation.comment : "";
	parkingNumberSelect.value = parking_reservation.parking_number;
}

function onParkingReservationLoadingError(request) {
	if (request) {
		alert("The requested parking reservation could not be loaded because of the following error:\r\n\r\n" + request.responseText);
	}
}

//needs fixing
function onParkingsLoadedCallback() {
	for (var i = 0; i < parking.length; i++) {
		var parkingOption = document.createElement("option");
		parkingOption.value = parking[i].id;
		parkingOption.innerText = parking[i].position;
		parkingSelect.appendChild(parkingOption);
	}

	var searchKeyValuePairs = window.location.search.substring(1).split("&");
	for (var i = 0; i < searchKeyValuePairs.length; i++) {
		var splitted = searchKeyValuePairs[i].split("=");
		if (splitted[0] == "sku" && splitted.length > 1) {
			sku = splitted[1];
		}
	}

	if (sku) {
		sendRequest("GET", "API/v1/ParkingReservation/" + sku, onParkingReservationLoaded, onParkingReservationLoadingError);

		parkingNumberSelect.disabled = true;
	}
	else {
		parkingNumberSelect.disabled = false;
	}
}

loadParkings(onParkingsLoadedCallback);
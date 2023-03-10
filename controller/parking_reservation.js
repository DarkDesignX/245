<<<<<<< HEAD
//create variable
var parking_number = null;

//create variable get parking information by id
=======
var id = null;

var reservationField = document.getElementById("parking-reservation-field");
>>>>>>> 10571c31b697ea17f560df668775fa9412bf661c
var userNameField = document.getElementById("name-field");
var startTimeField = document.getElementById("start-time-field");
var endTimeField = document.getElementById("end-time-field");
var commentField = document.getElementById("comment-field");
var parkingNumberSelect = document.getElementById("parking-number-select");

//function to edit the parking reservations
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

	if (id) {
		sendRequest("PUT", "API/v1/ParkingReservation/" + id, onParkingReservationSaved, onParkingReservationSavingError, parking_reservation);
	}
	else {
		sendRequest("POST", "API/v1/ParkingReservation", onParkingReservationSaved, onParkingReservationSavingError, parking_reservation);
	}
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

	reservationField.value = parking_reservation.parking_reservation,
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

//needs fixing
function onParkingsLoadedCallback() {
	for (var i = 0; i < parkings.length; i++) {
		var parkingOption = document.createElement("option");
		parkingOption.value = parkings[i].id;
		parkingOption.innerText = parkings[i].position;
		parkingNumberSelect.appendChild(parkingOption);
	}

	var searchKeyValuePairs = window.location.search.substring(1).split("&");
	for (var i = 0; i < searchKeyValuePairs.length; i++) {
		var splitted = searchKeyValuePairs[i].split("=");
		if (splitted[0] == "id" && splitted.length > 1) {
			id = splitted[1];
		}
	}

	if (id) {
		sendRequest("GET", "API/v1/ParkingReservation/" + id, onParkingReservationLoaded, onParkingReservationLoadingError);
	}
}

loadParkings(onParkingsLoadedCallback);
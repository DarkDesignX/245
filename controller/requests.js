//create variables
var request = null;
var currentSuccessCallback = null;
var currentErrorCallback = null;

//function to send request
function sendRequest(method, url, successCallback, errorCallback, body = null) {
	if (request) {
		alert("A request is already running. Please wait until it finished and try again afterwards!");
		errorCallback(null);
		return;
	}

	//get successful message or an error
	currentSuccessCallback = successCallback;
	currentErrorCallback = errorCallback;

	var stringBody = null;
	if (body) {
		stringBody = JSON.stringify(body);
	}

	request = new XMLHttpRequest();
	request.open(method, url);
	request.setRequestHeader("Content-Type", "application/json");
	request.onreadystatechange = onReadyStateChange;
	request.send(stringBody);
}

function onReadyStateChange(event) {
	if (request.readyState < 4) {
		return;
	}

	//the request is finished get a message on an error
	var finishedRequest = request;
	request = null;

	if (finishedRequest.status == 401) {
		loginOverlay.show();
	}	

	if (finishedRequest.status != 200 && finishedRequest.status != 201) {
		currentErrorCallback(finishedRequest);

		return;
	}

	//the login status (login or logout)
	if(loginStatus) {
		loginStatus.href = 'logout.php';
		loginStatus.updateButtonText('Ausloggen');
	}

	//finish the request
	currentSuccessCallback(finishedRequest);
}
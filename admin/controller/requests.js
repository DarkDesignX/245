var request = null;
var currentSuccessCallback = null;
var currentErrorCallback = null;

function sendRequest(method, url, successCallback, errorCallback, body = null) {
	if (request) {
		alert("A request is already running. Please wait until it finished and try again afterwards!");
		errorCallback(null);
		return;
	}

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

	var finishedRequest = request;
	request = null;	

	if (finishedRequest.status != 200 && finishedRequest.status != 201) {
		currentErrorCallback(finishedRequest);

		return;
	}

	currentSuccessCallback(finishedRequest);
}
var loginOverlay = document.getElementById("login-overlay");
var loginStatus = document.querySelector("#login-status");

var usernameField = document.getElementById("username-field");
var passwordField = document.getElementById("password-field");

function authenticate(event) {
	event.preventDefault();

	sendRequest("POST", "API/v1/Login", onLoginSuccess, onLoginError, {
		username: usernameField.value,
		password: passwordField.value
	});
}

loginStatus.updateButtonText = function (newText) {
	this.innerText = newText;
}
loginStatus.addEventListener('click', function (e) {
	if (this.innerText === 'Einloggen') {
		e.preventDefault();
		loginOverlay.show();
	}
})

loginOverlay.show = function () {
	this.classList.add('visible');
}
loginOverlay.hide = function () {
	this.classList.remove('visible');
}

function onLoginSuccess(request) {
	loginOverlay.classList.remove("visible");
}

function onLoginError(request) {
	alert("Invalid credentials. Please try again!");
}
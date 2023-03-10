//create variable get login information by id
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

//button to loggin
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

//successfully login
function onLoginSuccess(request) {
	loginOverlay.classList.remove("visible");
}

//login faild
function onLoginError(request) {
	alert("Invalid credentials. Please try again!");
}
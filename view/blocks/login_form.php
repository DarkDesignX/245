<!--create a div-->
<div class="overlay-container" id="login-overlay">
	<div class="overlay">
		<!--create a title-->
		<h1>Einloggen:</h1>
		<!--create labels and inputs to the username and password-->
		<form id="login-form" onsubmit="authenticate(event);">
			<label for="username-field">Benutzername:</label>
			<input type="text" id="username-field" placeholder="john.doe">
			<label for="password-field">Password</label>
			<input type="password" id="password-field" placeholder="••••••••">
			<button type="submit">Log in</button>
		</form>
	</div>
</div>

<!--connect with authentication.js-->
<script src="controller/authentication.js"></script>
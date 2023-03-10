<!--open the html-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $page_title ?? "Untitled Page"; ?></title>

		<link rel="stylesheet" href="view/stylesheets/style.css">
		<script src="controller/requests.js"></script>
	</head>
	<!--create body and add a navigation-->
	<body>
		<nav>
			<!--connect navigation with the php documents-->
			<a href="index.php">Home</a>
			<a href="rooms.php">Räume</a>
			<a href="parkings.php">Parkplätze</a>
			<a href="reservations.php">Buchungen</a>
			<a id="login-status" href="#">Einloggen</a>
		</nav>
		<div class="content-container">
			<div class="content">
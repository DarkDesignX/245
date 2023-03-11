<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $page_title ?? "Untitled Page"; ?></title>

		<link rel="stylesheet" href="view/stylesheets/style.css">
		<script src="controller/requests.js"></script>
	</head>
	<body>
		<nav>
			<a href="home.php">Home</a>
			<a href="rooms.php">Räume</a>
			<a href="parkings.php">Parkplätze</a>
			<a href="reservations.php">Buchungen</a>
			<a href="index.php">Log Out</a>
		</nav>
		<div class="content-container">
			<div class="content">
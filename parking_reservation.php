<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Parking Reservation"; ?>

<!--connect with page_start.php-->
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Parkplatz Reservation </h1>

<!--div to select Parking Number-->
<form onsubmit="onEditParkingReservationFormSubmitted(event);">
	<div class="field">
		<label for="parking-number-select">Parkplatz: </label>
		<select id="parking-number-select" required>
			<option value="">(Keine Parkplätze)</option>
		</select>
	</div>

	<!--div to select renter name-->
    <div class="field">
		<label for="name-field">Name: </label>
		<input type="text" id="name-field" required>
	</div>

	<!--div to select Parking Start Time-->
	<div class="field">
        <label for="start-time-field">Start Time: </label>
		<input type="datetime-local" id="start-time" required>
	</div>

	<!--div to select Parking End Time-->
    <div class="field">
        <label for="end-time-field">End Time: </label>
		<input type="datetime-local" id="end-time" required>
	</div>

	<!--div to select comments-->
	<div class="field">
        <label for="comment-field">Kommentar: </label>
		<textarea id="comment-field"></textarea>
	</div>

	<!--button to save the reservation-->
	<div class="field">
		<button type="submit">Parkplatz Reservieren</button>
	</div>
</form>

<!--connect with parking.js and parking_reservation.js-->
<script src="controller/parkings.js"></script>
<script src="controller/parking_reservation.js"></script>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>
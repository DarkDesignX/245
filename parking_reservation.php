<?php $page_title = "CsBe - BDM AG - Parking Reservation"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Parkplatz Reservation </h1>

<form onsubmit="onEditParkingReservationFormSubmitted(event);">
	<div class="field">
		<label for="parking-reservation-field">Betreff: </label>
		<input type="text" id="parking-reservation-field" required>
	</div>	

	<div class="field">
		<label for="parking-number-select">Parkplatz: </label>
		<select id="parking-number-select" required>
			<option value="">(Keine Parkplätze)</option>
		</select>
	</div>

    <div class="field">
		<label for="name-field">Name: </label>
		<input type="text" id="name-field" required>
	</div>

	<div class="field">
        <label for="start-time-field">Start Time: </label>
		<input type="datetime-local" id="start-time" required>
	</div>

    <div class="field">
        <label for="end-time-field">End Time: </label>
		<input type="datetime-local" id="end-time" required>
	</div>

	<div class="field">
        <label for="comment-field">Kommentar: </label>
		<textarea id="comment-field"></textarea>
	</div>

	<div class="field">
		<button type="submit">Parkplatz Reservieren</button>
	</div>
</form>

</div>
<div>
	<img src="images/Park.png" alt="Parkings" width="500">
</div>

<script src="controller/parkings.js"></script>
<script src="controller/parking_reservation.js"></script>
<?php require "view/blocks/page_end.php"; ?>
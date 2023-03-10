<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Raum Reservation"; ?>

<!--connect with page_start.php and add the titel-->
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Raum Reservation </h1>

<!--div to select a dropdown with romms name-->
<form onsubmit="onEditRoomReservationFormSubmitted(event);">
	<div class="field">
		<label for="room-name-select">Raum Name: </label>
        <select id="room-name-select" required>
			<option value="">(Keine Räume)</option>
		</select>
	</div>

	<!--div to select a input with renter name-->
	<div class="field">
		<label for="name-field">Name: </label>
		<input type="text" id="name-field" required>
	</div>

	<!--div to select a input for the start time-->
	<div class="field">
        <label for="start-time-field">Start Time: </label>
		<input type="datetime-local" id="start-time" required>
	</div>

	<!--div to select a input for the end time-->
    <div class="field">
        <label for="end-time-field">End Time: </label>
		<input type="datetime-local" id="end-time" required>
	</div>

	<!--div to select a input for the comment-->
	<div class="field">
        <label for="comment-field">Kommentar: </label>
		<textarea id="comment-field"></textarea>
	</div>

	<!--button to save the room reservation-->
	<div class="field">
		<button type="submit">Raum Reservieren</button>
	</div>
</form>

<!--connect with rooms.js and room_reservation.js-->
<script src="controller/rooms.js"></script>
<script src="controller/room_reservation.js"></script>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>

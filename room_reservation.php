<?php $page_title = "CsBe - BDM AG - Raum Reservation"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Raum Reservation </h1>

<form onsubmit="onEditRoomReservationFormSubmitted(event);">
	<div class="field">
		<label for="room-reservation-field">Betreff: </label>
		<input type="text" id="room-reservation-field" required>
	</div>	

	<div class="field">
		<label for="room-name-select">Raum Name: </label>
        <select id="room-name-select" required>
			<option value="">(Keine Räume)</option>
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
		<button type="submit">Raum Reservieren</button>
	</div>
</form>

<script src="controller/rooms.js"></script>
<script src="controller/room_reservation.js"></script>
<?php require "view/blocks/page_end.php"; ?>

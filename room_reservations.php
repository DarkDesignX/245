<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Room Reservations"; ?>

<!--connect with page_start.php and add the titel-->
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Raum Buchungen</h1>

<!--link to room_reservation.php through button-->
<div style="margin-bottom: 2em;">
	<a href="room_reservation.php" class="button">Create New Room Reservation</a>
</div>

<!--table to select the reservation informations-->
<table>
	<thead>
		<tr>
			<th>Reservation</th>
            <th>Raum</th>
			<th>Name</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody id="room-reservations-table"></tbody>
</table>

<!--connect with room_reservations.js-->
<script src="controller/room_reservations.js"></script>
<script>loadRoomReservationList();</script>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>
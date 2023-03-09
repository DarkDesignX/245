<?php $page_title = "CsBe - BDM AG - Room Reservations"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Raum Buchungen</h1>
<div style="margin-bottom: 2em;">
	<a href="room_reservation.php" class="button">Create New Room Reservation</a>
</div>
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
<script src="controller/room_reservations.js"></script>
<script>loadRoomReservationList();</script>

<?php require "view/blocks/page_end.php"; ?>
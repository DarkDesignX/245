<?php $page_title = "CsBe - BDM AG - Reservations"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Buchungen</h1>
<div style="margin-bottom: 2em;">
	<a href="parking_reservation.php" class="button">Create New Parking Reservation</a>
</div>
<table>
	<thead>
		<tr>
			<th>Parkplatz</th>
			<th>Name</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody id="parking-reservations-table"></tbody>
</table>
<script src="controller/parkingreservations.js"></script>
<br>
<br>
<br>
<br>
<div style="margin-bottom: 2em;">
	<a href="room_reservation.php" class="button">Create New Room Reservation</a>
</div>
<table>
	<thead>
		<tr>
            <th>Raum</th>
			<th>Name</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody id="room-reservations-table"></tbody>
</table>
<script src="controller/roomreservations.js"></script>

<?php require "view/blocks/page_end.php"; ?>
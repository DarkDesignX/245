<?php $page_title = "CsBe - BDM AG - Parking Reservations"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Parking Buchungen</h1>
<div style="margin-bottom: 2em;">
	<a href="parking_reservation.php" class="button">Create New Parking Reservation</a>
</div>
<table>
	<thead>
		<tr>
			<th>Reservation</th>
			<th>Parkplatz</th>
			<th>Name</th>
			<th>Start Time</th>
			<th>End Time</th>
		</tr>
	</thead>
	<tbody id="parking-reservations-table"></tbody>
</table>
<script src="controller/parking_reservations.js"></script>
<script>loadParkingReservationList();</script>

<?php require "view/blocks/page_end.php"; ?>
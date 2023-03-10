<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Parking Reservations"; ?>

<!--connect with page_start.php and add the titel-->
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Parking Buchungen</h1>

<!--link to parking_reservation.php through button-->
<div style="margin-bottom: 2em;">
	<a href="parking_reservation.php" class="button">Create New Parking Reservation</a>
</div>

<!--table to select the reservation informations-->
<table>
	<thead>
		<tr>
			<th>Reservation</th>
			<th>Parkplatz</th>
			<th>Name</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody id="parking-reservations-table"></tbody>
</table>

<!--connect with parking_reservations.js-->
<script src="controller/parking_reservations.js"></script>
<script>loadParkingReservationList();</script>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>
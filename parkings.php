<?php $page_title = "CsBe - BDM AG - Parkplätze"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1  id="title">Parkplätze</h1>

<table>
	<thead>
		<tr>
			<th>Parking Position</th>
		</tr>
	</thead>
	<tbody id="parkings-table"></tbody>
</table>
<br><br/>

<div style="margin-bottom: 2em;">
	<a href="parking_reservation.php" class="button">Einen Parkplatz reservieren</a>
</div>
<script src="controller/parkings.js"></script>
<script>loadParkingList();</script>
<?php require "view/blocks/page_end.php"; ?>

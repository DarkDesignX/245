<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Parkplätze"; ?>

<!--connect with page_start.php-->
<?php require "view/blocks/page_start.php"; ?>
<h1  id="title">Parkplätze</h1>

<!--table to list the parkings-->
<table>
	<thead>
		<tr>
			<th>Parking Position</th>
		</tr>
	</thead>
	<tbody id="parkings-table"></tbody>
</table>
<br><br/>

<!--link to parking_reservation.php through button-->
<div style="margin-bottom: 2em;">
	<a href="parking_reservation.php" class="button">Einen Parkplatz reservieren</a>
</div>

<!--connect with parkings.js-->
<script src="controller/parkings.js"></script>
<script>loadParkingList();</script>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>

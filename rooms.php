<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Räume"; ?>

<!--connect with page_start.php-->
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Räume</h1>

<!--table to list the rooms-->
<table>
	<thead>
		<tr>
			<th>Room Name</th>
			<th>Beschreibung</th>
			<th>Stockwerk</th>
			<th>Plätze</th>
		</tr>
	</thead>
	<tbody id="rooms-table"></tbody>
</table>
<br><br/>

<!--link to room_reservation.php through button-->
<div style="margin-bottom: 2em;">
	<a href="room_reservation.php" class="button">Einen Raum Reservieren</a>
</div>

<!--connect with rooms.js-->
<script src="controller/rooms.js"></script>
<script>loadRoomList();</script>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>
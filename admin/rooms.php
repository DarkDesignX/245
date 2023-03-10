<?php $page_title = "CsBe - BDM AG - Räume"; ?>
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Räume</h1>

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

<div style="margin-bottom: 2em;">
	<a href="room_reservation.php" class="button">Einen Raum Reservieren</a>
</div>

</div>

<div>
	<img src="images/CsBe.png" alt="EG" width="1200">
</div>

<script src="controller/rooms.js"></script>
<script>loadRoomList();</script>
<?php require "view/blocks/page_end.php"; ?>
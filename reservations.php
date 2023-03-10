<!--Titel for website-->
<?php $page_title = "CsBe - BDM AG - Parking Reservations"; ?>

<!--connect with page_start.php and add the titel-->
<?php require "view/blocks/page_start.php"; ?>
<h1 id="title">Buchungen</h1>

<!--links to parking_reservations.php and room_reservations.php through buttons-->
<div style="margin-bottom: 2em;">
	<a href="parking_reservations.php" class="button">Alle Parking Buchungen sehen</a>
    <a href="room_reservations.php" class="button">Alle Raum Buchungen sehen</a>
</div>

<!--connect with page_end.php-->
<?php require "view/blocks/page_end.php"; ?>
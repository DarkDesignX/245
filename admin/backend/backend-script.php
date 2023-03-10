<?php

$mysqli = new mysqli("localhost", "root", "", "245");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$sql = "SELECT * FROM parking_reservation";
$result = $mysqli->query($sql);

if (!$result) {
  echo "Error executing SQL statement: " . $mysqli->error;
}

$rows = array();
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

echo json_encode($rows);

$mysqli->close();

?>

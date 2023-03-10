<?php


$id = $_GET['id'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "245";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("DELETE FROM parking_reservation WHERE Id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute() === TRUE) {
  echo "parking reservation entry deleted successfully";
} else {
  echo "Error deleting parking reservation: " . $conn->error;
}


$stmt->close();
$conn->close();
?>

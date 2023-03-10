<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "245";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$name = $_POST['name'];
$parking = $_POST['parking'];
$licensePlate = $_POST['licensePlate'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];


$sql = "INSERT INTO reservation_parking (name, parking, LicensePlate, startDate, endDate)
VALUES ('$name', '$parkplatz', '$licensePlate', '$startDate', '$endDate')";

if (mysqli_query($conn, $sql)) {
  echo "New parking reservation created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

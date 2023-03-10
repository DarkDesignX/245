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
$room = $_POST['room'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];


$sql = "INSERT INTO registration_room (name, room, startDate, ExitDate)
VALUES ('$name', '$room', '$startDate', '$endDate')";

if (mysqli_query($conn, $sql)) {
  echo "New room reservation created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

mysqli_close($conn);
?>

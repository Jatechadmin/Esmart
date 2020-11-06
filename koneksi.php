<?php
$servername = "localhost";
$username = "u774182381_ag28m";
$password = "EspESDM@123";
$dbname = "u774182381_DT3Tt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM db_pelanggan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
} else {
  echo "0 results";
}
$conn->close();
?>

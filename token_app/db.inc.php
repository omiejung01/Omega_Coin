<?php

$servername = "localhost"; // Or your host name (e.g., "db.example.com")
$username = "omega_admin";
$password = "S9SLGu94zfWRb5wC";
$dbname = "omega_coin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";

// Close connection
// $conn->close();

?>
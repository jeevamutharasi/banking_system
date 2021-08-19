<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mirwais";
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connection) {
  die("CConnection failed>: " . mysqli_connect_error());
}
?>

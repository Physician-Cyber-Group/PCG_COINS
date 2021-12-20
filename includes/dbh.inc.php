<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "pcg_network_maid";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  header("Location: ../index.php");
  die("Connection Failed" .mysqli_connect_error());
  exit();
}

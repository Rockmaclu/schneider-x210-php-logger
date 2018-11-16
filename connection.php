<?php
  $servername = "localhost";
  $username = "id7871117_admin";
  $password = "admin1";
  $dbname = "id7871117_energy_metter";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
?>

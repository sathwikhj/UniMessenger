<?php
  // Database connection parameters
  $hostname = "localhost"; // The server where the database is hosted
  $username = "root";      // The username for connecting to the database
  $password = "";          // The password for connecting to the database
  $dbname = "chatapp";     // The name of the database

  // Creating a connection to the database
  $conn = mysqli_connect($hostname, $username, $password, $dbname);

  // Checking if the connection was successful
  if (!$conn) {
    // Display an error message if the connection fails
    echo "Database connection error: " . mysqli_connect_error();
  }
?>

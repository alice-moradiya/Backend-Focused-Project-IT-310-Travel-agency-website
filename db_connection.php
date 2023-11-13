<?php
// db_connection.php

$servername = "localhost";
$username = "root";
$password = "Aa123456@";
$database = "travel_system";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $database);

// to Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

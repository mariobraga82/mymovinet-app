<?php
$servername = "showmestuff-1.ca4clfzcsn8x.eu-west-2.rds.amazonaws.com";
$username = "mysqladmin";
$password = "P4ssword12345";
$dbname = "entertainment";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Create connection with database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 
?>

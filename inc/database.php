<?php
$servername = "showmestuff-db.cbcebkle1jza.eu-west-1.rds.amazonaws.com";
$username = "dev";
$password = "iHP5aRC06bfKslq7";
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
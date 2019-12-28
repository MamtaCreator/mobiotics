<?php
$servername = "localhost";
$username = "root";
$password = "";
$DBName = "userdetails";

// Create connection
$conn = new mysqli($servername, $username, $password,$DBName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
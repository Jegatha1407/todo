<?php
$servername = "127.0.0.1:3307"; // Default MySQL port is 3306
$username = "root";             // Default in XAMPP
$password = "";                 // Default password is empty
$database = "todo_db";         // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

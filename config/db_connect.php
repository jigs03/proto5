<?php
// Database connection credentials
$servername = "localhost"; // Replace with your database server (default: localhost)
$username = "root";        // Replace with your database username (default: root)
$password = "";            // Replace with your database password (default: empty for XAMPP)
$dbname = "smartdegreeupnm"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

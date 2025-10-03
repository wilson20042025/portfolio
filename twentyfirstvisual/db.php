<?php
// Database configuration
$host = 'localhost';      // Usually 'localhost' when using phpMyAdmin locally
$dbname = 'twentyfirstvisual'; // Change this to your actual database name
$username = 'root';        // Default username for localhost
$password = '';            // Default password for localhost (often empty)

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to UTF-8
$conn->set_charset("utf8");

// Uncomment to confirm connection
// echo "Connected successfully";
?>

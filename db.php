<?php
// Database configuration
$host = 'sql201.infinityfree.com';      // Usually 'localhost' when using phpMyAdmin locally
$dbname = 'if0_39057357_twentyfirstvisual'; // Change this to your actual database name
$username = 'if0_39057357';        // Default username for localhost
$password = 'HZSzN5CNp9dqZ';            // Default password for localhost (often empty)

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

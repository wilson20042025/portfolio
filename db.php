<?php
// Load credentials from the private config file
$config = include(__DIR__ . '/../../config.php');

$host = $config['host'];
$dbname = $config['dbname'];
$username = $config['username'];
$password = $config['password'];

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

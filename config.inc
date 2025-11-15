<?php
// config.inc - Establishes database connection using settings.php

// Include the settings file
require_once('settings.php');

// Create a connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set character encoding
$conn->set_charset("utf8mb4");

// You can use $conn in other included PHP files after this
?>

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

// Function to get all jobs
function getAllJobs() {
    global $conn;
    
    // Get ALL jobs (no is_active filter since column doesn't exist)
    $sql = "SELECT * FROM jobs ORDER BY posted_date DESC";
    $result = $conn->query($sql);
    
    $jobs = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jobs[] = $row;
        }
    }
    
    return $jobs;
}

// Function to get job by reference number
function getJobByReference($reference) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE reference_number = ?");
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

// Function to get jobs by category
function getJobsByCategory($category) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE category = ? ORDER BY posted_date DESC");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $jobs = [];
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
    
    return $jobs;
}

// Simple database connection
function getDBConnection() {
    $host = 'localhost';
    $dbname = 'quantumaxis_db';
    $username = 'quantumaxis_user';
    $password = 'quantumaxis_password123';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}
?>
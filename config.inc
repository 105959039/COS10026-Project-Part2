<?php
// config.inc - Establishes database connection using settings.php

require_once('settings.php');

// Create MySQLi connection (used for job pages)
$conn = new mysqli($host, $user, $pswd, $dbnm);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// ---------------- MySQLi job functions ----------------

function getAllJobs() {
    global $conn;
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

function getJobByReference($reference) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE reference_number = ?");
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

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

// ---------------- PDO function ONLY for about.php ----------------

function getDBConnection() {
    global $host, $user, $pswd, $dbnm;

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbnm;charset=utf8mb4", $user, $pswd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        error_log("PDO Connection failed: " . $e->getMessage());
        return null;
    }
}
?>

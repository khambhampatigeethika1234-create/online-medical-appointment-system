<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "medical_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Database connected successfully

?>
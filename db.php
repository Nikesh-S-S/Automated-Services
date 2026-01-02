<?php
$servername = "localhost";
$username = "root";
$password = ""; // default password, change if applicable
$dbname = "automatedcarservices";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

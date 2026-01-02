<?php
// submit_booking.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "automatedcarservices"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data safely
$serviceType = isset($_POST['serviceType']) ? $_POST['serviceType'] : '';
$customerName = isset($_POST['customerName']) ? $_POST['customerName'] : '';
$customerEmail = isset($_POST['customerEmail']) ? $_POST['customerEmail'] : '';
$customerPhone = isset($_POST['customerPhone']) ? $_POST['customerPhone'] : '';
$appointmentDate = isset($_POST['appointmentDate']) ? $_POST['appointmentDate'] : '';

// Insert data into the database
$sql = "INSERT INTO bookings (service_type, customer_name, customer_email, customer_phone, appointment_date) 
        VALUES ('$serviceType', '$customerName', '$customerEmail', '$customerPhone', '$appointmentDate')";

if ($conn->query($sql) === TRUE) {
    echo "Your booking for " . htmlspecialchars($serviceType) . " has been successfully confirmed!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

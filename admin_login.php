<?php
include 'db_connection.php'; // Include your database connection
session_start(); // Start the session to store user data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['adminEmail'];
    $password = $_POST['adminPassword'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        echo "Admin logged in successfully.";

        // Fetch booking data after successful login
        $stmt = $conn->prepare("SELECT * FROM bookings");
        $stmt->execute();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Store bookings in session
        $_SESSION['bookings'] = $bookings;

        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>

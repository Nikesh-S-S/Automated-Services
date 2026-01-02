<?php
session_start(); // Start the session
include('db_connection.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Using 'email' instead of 'username' for consistency with form
    $email = $_POST['username']; // You may want to change this in your HTML form as well
    $password = $_POST['password'];

    // Prepare SQL query to check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email"); 
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            header("Location: Services_login.html"); // Redirect to user dashboard
            exit();
        } else {
            echo "<script>alert('Invalid email or password'); window.location.href='LOGIN.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='LOGIN.html';</script>";
    }
}
?>

<?php
include('db_connection.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmailStmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $checkEmailStmt->bindParam(':email', $email);
    $checkEmailStmt->execute();

    if ($checkEmailStmt->rowCount() > 0) {
        echo "<script>alert('Email already registered.'); window.location.href='LOGIN.html';</script>";
    } else {
        // Prepare the SQL statement to insert the new user
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword); // Store hashed password
        $stmt->execute();

        echo "<script>alert('Registration successful!'); window.location.href='LOGIN.html';</script>";
    }
}
?>

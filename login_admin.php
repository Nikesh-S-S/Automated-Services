<?php
session_start(); // Start the session
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['adminEmail']) ? $_POST['adminEmail'] : null;
    $password = isset($_POST['adminPassword']) ? $_POST['adminPassword'] : null;

    if ($email && $password) {
        try {
            // Prepare a query to check if admin exists
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($password, $admin['password'])) {
                // Store admin session
                $_SESSION['admin_logged_in'] = true;
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
                exit();
            } else {
                echo "Invalid email or password";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Email and password are required.";
    }
}
$conn = null;
?>

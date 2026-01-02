<?php
include 'db_connection.php';

try {
    // Define admin accounts with usernames and hashed passwords
    $admins = [
        ['email' => 'nikesh@gmail.com', 'password' => password_hash('Nikesh1234', PASSWORD_BCRYPT)],
        ['email' => 'vijo@gmail.com', 'password' => password_hash('Vijo1234', PASSWORD_BCRYPT)],
        ['email' => 'surendhar@gmail.com', 'password' => password_hash('Suren1234', PASSWORD_BCRYPT)],
        ['email' => 'vimal@gmail.com', 'password' => password_hash('Vimal1234', PASSWORD_BCRYPT)]
    ];

    // Insert each admin record
    $stmt = $conn->prepare("INSERT INTO admin (email, password) VALUES (:email, :password)");
    foreach ($admins as $admin) {
        $stmt->bindParam(':email', $admin['email']);
        $stmt->bindParam(':password', $admin['password']);
        $stmt->execute();
    }

    echo "Admin records added successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<?php
session_start(); // Start the session
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login_admin.php");
    exit();
}

try {
    // Fetch all registered users
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all bookings
    $stmt = $conn->prepare("SELECT * FROM bookings");
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add the above CSS styles here if not using an external stylesheet */
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Registered Users</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Booking Details</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Service Type</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Appointment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['service_type']); ?></td>
                        <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['customer_email']); ?></td>
                        <td><?php echo htmlspecialchars($booking['customer_phone']); ?></td>
                        <td><?php echo htmlspecialchars($booking['appointment_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="LOGIN.html" class="logout-button">Logout</a>
    </div>
    <style>
        .dashboard-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background: linear-gradient(to right, #f0f0f0, #ffffff);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
    margin-bottom: 20px;
}

.user-table, .booking-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
}

.user-table th, .booking-table th,
.user-table td, .booking-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.user-table th, .booking-table th {
    background-color: #4CAF50; /* Green */
    color: white;
}

.user-table tr:nth-child(even), .booking-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.user-table tr:hover, .booking-table tr:hover {
    background-color: #ddd;
}

.logout-button {
    display: inline-block;
    padding: 10px 15px;
    margin-top: 20px;
    background-color: #ff4c4c; /* Red */
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.logout-button:hover {
    background-color: #ff1a1a;
}

        </style>
</body>
</html>

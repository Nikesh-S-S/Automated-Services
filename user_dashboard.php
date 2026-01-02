<?php
session_start();

// Include the database connection file
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: LOGIN.html");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch car details from the database
try {
    $stmt = $conn->prepare("SELECT * FROM car_details WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $carDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user_dashboard.css">
</head>
<body>
    <div class="dashboard">
        <h1>Your Car Dashboard</h1>

        <div class="car-details">
            <?php if (count($carDetails) > 0): ?>
                <?php foreach ($carDetails as $car): ?>
                    <div class="car-card">
                        <img src="<?php echo htmlspecialchars($car['image_path']); ?>" alt="Car Image" class="car-image">
                        <div class="car-info">
                            <h2>Condition: <?php echo htmlspecialchars($car['car_condition']); ?></h2>
                            <h3>Installed Services:</h3>
                            <p><?php echo htmlspecialchars($car['installed_services']); ?></p>
                            <p>Total Cost: $<?php echo htmlspecialchars($car['service_cost']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No car details found.</p>
            <?php endif; ?>
        </div>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

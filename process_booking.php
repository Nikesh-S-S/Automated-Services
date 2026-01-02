<?php
// Database connection details
$host = 'localhost'; // or your server host
$dbname = 'automatedcarservices'; // Database name
$username = 'root'; // Database username (change if needed)
$password = ''; // Database password (change if needed)

try {
    // Create a new PDO instance for database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from form fields
        $service_type = $_POST['serviceType'];
        $customer_name = $_POST['customerName'];
        $customer_email = $_POST['customerEmail'];
        $customer_phone = $_POST['customerPhone'];
        $appointment_date = $_POST['appointmentDate'];

        // Check for duplicate booking
        $checkSql = "SELECT COUNT(*) FROM bookings WHERE service_type = :service_type AND customer_name = :customer_name";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':service_type', $service_type);
        $checkStmt->bindParam(':customer_name', $customer_name);
        $checkStmt->execute();

        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            echo "Service already booked.";
        } else {
            // Prepare SQL query to insert data
            $sql = "INSERT INTO bookings (service_type, customer_name, customer_email, customer_phone, appointment_date) 
                    VALUES (:service_type, :customer_name, :customer_email, :customer_phone, :appointment_date)";

            $stmt = $conn->prepare($sql);

            // Bind parameters to prevent SQL injection
            $stmt->bindParam(':service_type', $service_type);
            $stmt->bindParam(':customer_name', $customer_name);
            $stmt->bindParam(':customer_email', $customer_email);
            $stmt->bindParam(':customer_phone', $customer_phone);
            $stmt->bindParam(':appointment_date', $appointment_date);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Booking successfully recorded.";
            } else {
                echo "Failed to record booking. Please try again.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>

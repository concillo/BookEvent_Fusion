<?php
// Start session
session_start();

// Database connection parameters
include('connector.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is set in session
if (!isset($_SESSION['user_id'])) {
    die("User ID is not set in session.");
}

// Retrieve user ID from session
$userId = $_SESSION['user_id'];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $date = mysqli_real_escape_string($conn, $_POST["event_date"]);
    $startTime = mysqli_real_escape_string($conn, $_POST["start_time"]);
    $endTime = mysqli_real_escape_string($conn, $_POST["end_time"]);
    $eventType = mysqli_real_escape_string($conn, $_POST["event_type"]);
    $eventStyle = mysqli_real_escape_string($conn, $_POST["event_style"]);
    $guestCount = mysqli_real_escape_string($conn, $_POST["guest_count"]);
    $preferredCuisine = mysqli_real_escape_string($conn, $_POST["preferred_cuisine"]);
    $budget = mysqli_real_escape_string($conn, $_POST["budget"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $ambiance = mysqli_real_escape_string($conn, $_POST["ambiance"]);
    $alcohol = mysqli_real_escape_string($conn, $_POST["alcohol_and_beverage"]);
    $specialRequest = mysqli_real_escape_string($conn, $_POST["special_requests"]);

    // Validate numeric fields
    if (!is_numeric($guestCount) || !is_numeric($budget)) {
        die("Guest count and budget must be numeric values.");
    }

    // Prepare and execute SQL statement using prepared statements
    $sql = "INSERT INTO user_requests (user_id, event_date, start_time, end_time, event_type, event_style, guest_count, preferred_cuisine, budget, location, ambiance, alcohol_and_beverage, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssissssss", $userId, $date, $startTime, $endTime, $eventType, $eventStyle, $guestCount, $preferredCuisine, $budget, $location, $ambiance, $alcohol, $specialRequest);
    
    if ($stmt->execute()) {
        echo "Event preferences submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No data received from the form.";
}

// Close database connection
$conn->close();
?>

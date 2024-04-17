<?php
session_start(); // Start the session if not already started
include 'connector.php'; // Include your database connection

// Check if form is submitted and data is available
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $venue_id = isset($_POST['venue_id']) ? $_POST['venue_id'] : "";
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ""; // Assuming user_id is stored in the session
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : "";
    $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : "";
    $booking_time = isset($_POST['booking_time']) ? $_POST['booking_time'] : "";
    $phone_number = isset($_POST['phone_number']) ? mysqli_real_escape_string($conn, $_POST['phone_number']) : "";
    $number_of_guest = isset($_POST['number_of_guest']) ? $_POST['number_of_guest'] : "";
    $comments = isset($_POST['comments']) ? mysqli_real_escape_string($conn, $_POST['comments']) : "";

    // Insert data into the database
    $sql = "INSERT INTO bookings (venue_id, user_id, name, booking_date, booking_time, phone_number, number_of_guest, comments) 
            VALUES ('$venue_id', '$user_id', '$name', '$booking_date', '$booking_time', '$phone_number', '$number_of_guest', '$comments')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page or do further processing
        header("Location: booking_success.php");
        exit();
    } else {
        // Handle errors
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Redirect to the form page if accessed directly without submitting the form
    header("Location: booking_form.php");
    exit();
}

$conn->close();
?>

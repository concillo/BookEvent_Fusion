<?php
// confirm_booking.php

// Database connection parameters
include('../connector.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the venue ID, user ID, and user request ID from the POST data
    $venue_id = $_POST['venue_id'];
    $user_id = $_POST['user_id'];
    $user_request_id = $_POST['user_request_id'];

    // SQL query to update the venue availability
    $sql = "UPDATE venue SET available = 'No' WHERE venue_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venue_id);

    // Execute the query to update venue availability
    if ($stmt->execute()) {
        // SQL query to insert confirmation details into the bookings table
        $sql_insert = "INSERT INTO booking (user_id, venue_id, user_request_id) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iii", $user_id, $venue_id, $user_request_id);

        // Execute the insert query
        if ($stmt_insert->execute()) {
            // Send JSON response with success status and redirect URL
            $response = array(
                'success' => true,
                'redirect_url' => 'menu.php' // Change the redirect URL as needed
            );
            echo json_encode($response);
        } else {
            // Send JSON response with error message
            $response = array(
                'success' => false,
                'message' => 'Failed to confirm booking. Please try again.'
            );
            echo json_encode($response);
        }
        $stmt_insert->close();
    } else {
        // Send JSON response with error message
        $response = array(
            'success' => false,
            'message' => 'Failed to update venue availability. Please try again.'
        );
        echo json_encode($response);
    }
    $stmt->close();
} else {
    // If the request method is not POST, display an error message
    // Send JSON response with error message
    $response = array(
        'success' => false,
        'message' => 'Invalid request method.'
    );
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>

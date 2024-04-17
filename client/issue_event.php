<?php
session_start(); // Start the session

// Database connection parameters
include ('connector.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
        // If user is logged in, retrieve user ID from session
        $user_id = $_SESSION['user_id'];
    } else {
        // Redirect user to login page or handle unauthorized access
        header("Location: login.php");
        exit();
    }
    
    $id = $_POST['id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue = $_POST['venue'];
    $event_type = $_POST['event_type'];
    $event_style = $_POST['event_style'];
    $guest_count = $_POST['guest_count'];
    $preferred_cuisine = $_POST['preferred_cuisine'];
    $budget = $_POST['budget'];
    $location = $_POST['location'];
    $ambiance = $_POST['ambiance'];
    $alcohol_and_beverage = $_POST['alcohol_and_beverage'];
    $special_requests = $_POST['special_requests'];
    $alcohol = $_POST['alcohol'];
    
    // SQL query to insert data
    $sql = "INSERT INTO user_requests (id, user_id, event_name, event_date, start_time, end_time, venue, event_type, event_style, guest_count, preferred_cuisine, budget, location, ambiance, alcohol_and_beverage, special_requests, alcohol) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssssiisisssss", $id, $user_id, $event_name, $event_date, $start_time, $end_time, $venue, $event_type, $event_style, $guest_count, $preferred_cuisine, $budget, $location, $ambiance, $alcohol_and_beverage, $special_requests, $alcohol);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

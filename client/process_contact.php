<?php
// Database connection
include("connector.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$additional_info = $_POST['additional_info'];

// Prepare and execute SQL statement to insert data into database
$sql = "INSERT INTO contact_info (name, email, phone, additional_info) VALUES ('$name', '$email', '$phone', '$additional_info')";

if ($conn->query($sql) === TRUE) {
    echo "Contact information saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>

<?php
include 'connector.php';

$vendorId = $_POST['vendor_id'];
$eventDate = $_POST['event_date'];
$sql = "UPDATE vendors SET availability = '$eventDate' WHERE id = '$vendorId'";
if ($conn->query($sql) === TRUE) {
    echo "<p>Vendor booked successfully!</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
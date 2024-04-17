<?php
include('../connector.php');

if(isset($_GET['id'])) {
    $venue_id = $_GET['id'];

    $sql = "DELETE FROM venues WHERE id = '$venue_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Venue deleted successfully";
    } else {
        echo "Error deleting venue: " . $conn->error;
    }
} else {
    echo "Venue ID not provided.";
}

$conn->close();
?>

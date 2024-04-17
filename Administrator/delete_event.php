<?php
include('connector.php');

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $eventId = $_POST['id'];
    
    $delete_query = "DELETE FROM events WHERE id = $eventId";
    if ($conn->query($delete_query) === TRUE) {
        echo "Event deleted successfully.";
    } else {
        echo "Error deleting event: " . $conn->error;
    }
} else {
    echo "Invalid event ID.";
}
?>

<?php
include('../connector.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['id'];
    $status = $_POST['status'];
    $official_remark = $_POST['official_remark'];

    $sql = "UPDATE bookings SET bookingStatus='$status', adminremark='$official_remark' WHERE id='$booking_id'";

    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT * FROM bookings WHERE id='$booking_id'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['updated_booking'] = $row;
        }
        
        header('Location: booking_details.php');
        exit();
    } else {
        echo "Error updating booking status: " . $conn->error;
    }
}

$conn->close();
?>

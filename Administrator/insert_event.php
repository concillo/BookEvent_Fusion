<?php
include('connector.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event = $_POST['event'];
    $description = $_POST['description'];
    $schedule = $_POST['schedule'];
    $type = $_POST['type'];
    $audience_capacity = $_POST['audience_capacity'];
    $payment_type = $_POST['payment_type'];
    $amount = $_POST['amount'];
    $venue_id = $_POST['venue_id'];

    $banner = ''; 
    if(isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $banner_tmp_name = $_FILES['banner']['tmp_name'];
        $banner_name = $_FILES['banner']['name'];
        $banner = './images' . $banner_name; 
        move_uploaded_file($banner_tmp_name, $banner);
    }

    $sql = "INSERT INTO events (user_id, event, description, schedule, type, audience_capacity, payment_type, amount, banner, date_created, venue_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssiiidsi", $user_id, $event, $description, $schedule, $type, $audience_capacity, $payment_type, $amount, $banner, $venue_id);

    $user_id = 1;

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

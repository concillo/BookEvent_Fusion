<?php
include('connector.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $eventId = $_GET['id'];
    
    $event_query = "SELECT * FROM events WHERE id = $eventId";
    $event_result = $conn->query($event_query);

    if ($event_result->num_rows > 0) {
        $event = $event_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="card-title">Event Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Schedule:</strong> <?php echo date("M d, Y h:i A", strtotime($event['schedule'])); ?></p>
                    <p><strong>Type:</strong> <?php echo $event['type'] == 1 ? "Public" : "Private"; ?></p>
                    <p><strong>Capacity:</strong> <?php echo $event['audience_capacity']; ?></p>
                    <p><strong>Description:</strong> <?php echo $event['description']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
    } else {
        echo "Event not found.";
    }
} else {
    echo "Invalid event ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venues</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .navbar {
    height: 60px !important; /* Adjust the height as needed */
    background-color: black !important; /* Set the background color to transparent */
}

.navbar-dark .navbar-nav .nav-link {
    color: white;
}
        .container {
            margin-top: 100px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 20px;
        }

        .venue-card {
            width: 200px;
            padding: 20px;
            background-color: #343a40;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .venue-card:hover {
            background-color: #495057;
        }

        .venue-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .venue-name {
            font-size: 18px;
        }
    </style>
</head>
<body>

    <?php
        // Database connection parameters
        include('../connector.php');
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
  // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT u.username, ur.id, ur.event_date, ur.start_time, ur.end_time, ur.venue, ur.event_type, ur.guest_count, ur.budget,ur.ambiance, ur.special_requests
    FROM users u
    INNER JOIN user_requests ur ON u.id = ur.user_id
    WHERE u.store = 'Italian'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='request'>";
            echo "<p><strong>Username:</strong> " . $row["username"] . "</p>";
            echo "<p><strong>Event Name:</strong> " . $row["event_name"] . "</p>";
            echo "<p><strong>Event Date:</strong> " . $row["event_date"] . "</p>";
            echo "Start Time: " . $row["start_time"] . "<br>";
            echo "End Time: " . $row["end_time"] . "<br>";
            echo "Venue: " . $row["venue"] . "<br>";
            echo "Event Type: " . $row["event_type"] . "<br>";
            echo "Guest Count: " . $row["guest_count"] . "<br>";
             echo "Budget: " . $row["budget"] . "<br>";
            echo "Location: " . $row["location"] . "<br>";
            echo "Ambiance: " . $row["ambiance"] . "<br>";
            echo "Alcohol and Beverage: " . $row["alcohol_and_beverage"] . "<br>";
            echo "Special Requests: " . $row["special_requests"] . "<br>";
            echo "<button class='add-button' onclick='location.href=\"../add_event.php?id=" . $row["id"] . "\";'>Add Event</button>";
            echo "</div>";
    }

}
        } else {
            echo "No user requests from the Italian store found";
        }

        // Close database connection
        $conn->close();
    ?>
</div>
</body>
</html>

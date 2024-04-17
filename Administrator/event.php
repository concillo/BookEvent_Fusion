
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venues</title>
    <link rel="website icon" type="jpg" href="images/logo.jpg">
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
            height: 60px !important;
            /* Adjust the height as needed */
            background-color: black !important;
            /* Set the background color to transparent */
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Event Management</a>
        <div class="ml-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="event.php">Venues Available</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Events</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><?php include("../connector.php");

// Select all venues from the database
$query = "SELECT venue_id, venue_name, available, img FROM venue";
$result = mysqli_query($conn3, $query);

if ($result) {
    // Check if there are any venues
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of the result set
        while ($venue = mysqli_fetch_assoc($result)) {
            // Display venue details within a box
            echo "<div class='venue-box'>";
            echo "<h2>Venue:</h2>";
            echo "<p>Venue Name: " . $venue['venue_name'] . "</p>";
            echo "<p>Availability: " . $venue['available'] . "</p>";
            echo "<img src='../venues/" . $venue['img'] . "' alt='Venue Image'>";
            // Hidden input field for venue id
            echo "<input type='hidden' name='venue_id' value='" . $venue['venue_id'] . "'>";
            
            // Button for creating an event for this venue
            echo "<a href='add_venues.php?venue_id=" . $venue['venue_id'] . "' class='create-event-button'>Create Event</a>";
            
            echo "</div>";
        }
    } else {
        echo "No venues found.";
    }
} else {
    echo "Error retrieving venues: " . mysqli_error($conn3);
}
?>
<style>
    .venue-box {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .create-event-button {
        display: block;
        width: 150px;
        padding: 10px;
        text-align: center;
        margin-top: 10px;
        border: 2px solid #007bff;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
    }

    .create-event-button:hover {
        background-color: #0056b3;
    }
</style>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</body>

</html>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Event Management</a>
        <div class="ml-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Venues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
    </nav>
        </div>
    <h2>Check Venue Availability</h2>
    <form action="check_availability.php" method="post">
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required><br><br>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" required><br><br>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" required><br><br>

        <label for="venue_preferences">Venue Preferences:</label>
        <input type="text" id="venue_preferences" name="venue_preferences" required><br><br>

        <input type="submit" value="Check Availability">
    </form>
</body>
</html>

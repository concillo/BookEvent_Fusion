<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Availability</title>
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
        </div>
    </nav>
       
    <div class="container">
        <h1>Venue Availability</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Venue Name</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection parameters
                    include('../connector.php');

                    // Check connection
                    if ($conn3->connect_error) {
                        die("Connection failed: " . $conn3->connect_error);
                    }

                    // Query to fetch venue availability data
                    $sql = "SELECT venue_id, venue_name, available FROM venue";
                    $result = $conn3->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["venue_name"] . "</td>";
                            echo "<td>" . ($row["available"] ? "Available" : "Not Available") . "</td>";
                            // Display the Confirm button only if the venue is available
                            if ($row["available"]) {
                                echo "<td><button class='btn btn-primary confirm-btn' data-venue-id='" . $row["venue_id"] . "' data-user-id='" . $_GET['user_id'] . "' data-user-request-id='" . $_GET['request_id'] . "'>Confirm</button></td>";
                            } else {
                                // Display the Decline button if the venue is not available
                                echo "<td><button class='btn btn-danger' disabled>Decline</button></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No venue available</td></tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Add event listeners to Confirm buttons
        document.querySelectorAll('.confirm-btn').forEach(button => {
            button.addEventListener('click', () => {
                const venueId = button.dataset.venueId;
                const userId = button.dataset.userId;
                const userRequestId = button.dataset.userRequestId;

                fetch('confirm_booking.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `venue_id=${venueId}&user_id=${userId}&user_request_id=${userRequestId}`,
                })
                .then(response => response.json())
                .then(data => {
                    // Check if the booking was successful
                    if (data.success) {
                        // Redirect to the specified URL
                        window.location.href = data.redirect_url;
                    } else {
                        // Display an error message
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Display an error message to the user
                    alert('Failed to confirm booking. Please try again.');
                });
            });
        });
    </script>
</body>
</html>

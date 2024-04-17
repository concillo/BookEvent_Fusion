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

        /* Table Style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User Request Details</h1>
    <div class="section">
        <h2>User Request</h2>
        <div class="table-container">
            <table class="table">
                <?php
                // Database connection parameters
                include('../connector.php');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve data from user_requests table
                $sql_user_requests = "SELECT * FROM user_requests WHERE id = ?";
                $stmt = $conn->prepare($sql_user_requests);
                $stmt->bind_param("i", $_GET['id']);
                $stmt->execute();
                $result_user_requests = $stmt->get_result();

                if ($result_user_requests->num_rows > 0) {
                    echo "<tr><th>ID</th><th>User ID</th><th>Event Date</th><th>Details</th></tr>";
                    while ($row = $result_user_requests->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td><strong>Event Date:</strong> " . $row["event_date"] . "</td>";
                        echo "<td>Start Time: " . $row["start_time"] . "<br>";
                        echo "End Time: " . $row["end_time"] . "<br>";
                        echo "Venue: " . $row["venue"] . "<br>";
                        echo "Event Type: " . $row["event_type"] . "<br>";
                        echo "Guest Count: " . $row["guest_count"] . "<br>";
                        echo "Budget: " . $row["budget"] . "<br>";
                        echo "Ambiance: " . $row["ambiance"] . "<br>";
                        echo "Special Requests: " . $row["special_requests"] . "<br>";
                     echo "</tr>";
                        // Adding the Check Availability button inside the loop
                        echo "<tr><td colspan='4'><a href='check_availability.php?user_id=" . $row['user_id'] . "&request_id=" . $row['id'] . "' class='btn btn-primary'>Check Availability</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No user request found</td></tr>";
                }

                $stmt->close();
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

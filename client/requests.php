

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: black;
            color: white;
            padding: 10px 20px;
            z-index: 1000;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            color: white;
            padding-top: 20px;
            overflow-y: auto;
            z-index: 100;
            display: none;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
            color: white;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-requests {
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <span class="navbar-brand">Booking Venue Management</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="toggleSidebar()"><i
                            class="fas fa-home"></i>Home</a>
                    <div class="sidebar" id="sidebar">
                        <a href="venues.php"><i class="fas fa-map-marker-alt"></i>Find Venue</a>
                        <a href="planning.php"><i class="fas fa-calendar-plus"></i>Create Venue</a>
                        <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                        <a href="lists.php"><i class="fas fa-bookmark"></i>My Bookings</a>
                        <a href="requests.php"><i class="fas fa-envelope"></i>Requests</a>
                        <a href="abouts.php"><i class="fas fa-info-circle"></i>About</a>
                        <a href="activity_logs.php"><i class="fas fa-history"></i>Activity Logs</a>
                        <a href="../index.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

<div class="container">
<?php
// Include your database connection file
include('connector.php');
session_start();
$user_id = $_SESSION["user_id"];
    
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $ambiance = mysqli_real_escape_string($conn, $_POST['ambiance']);
    
    $event_type = $_POST['event_type'];
    $guest_count = $_POST['guest_count'];
    $budget = $_POST['budget'];
    $special_requests = $_POST['special_requests'];

    // Insert data into the database
    $sql = "INSERT INTO user_requests (user_id, event_date, start_time, end_time, venue, ambiance, event_type, guest_count, budget, special_requests)
            VALUES ('$user_id', '$event_date', '$start_time', '$end_time', '$venue', '$ambiance', '$event_type', '$guest_count', '$budget', '$special_requests')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to menu.php after successful insertion
        header("Location: menu.php?id=$user_id");
        exit(); // Ensure that no other output is sent before the redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

</div>


<footer class="footer">
 <div class="container">
        <h2>All Requests</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Event Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Venue</th>
                        <th>Ambiance</th>
                        <th>Event Type</th>
                        <th>Guest Count</th>
                        <th>Budget</th>
                        <th>Special Requests</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include your database connection file
                    include ('connector.php');
                    session_start();
                    $user_id = $_SESSION["user_id"];

                    // Fetch all requests for the logged-in user
                    $sql = "SELECT * FROM user_requests WHERE user_id = '$user_id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["event_date"] . "</td>";
                            echo "<td>" . $row["start_time"] . "</td>";
                            echo "<td>" . $row["end_time"] . "</td>";
                            echo "<td>" . $row["venue"] . "</td>";
                            echo "<td>" . $row["ambiance"] . "</td>";
                            echo "<td>" . $row["event_type"] . "</td>";
                            echo "<td>" . $row["guest_count"] . "</td>";
                            echo "<td>" . $row["budget"] . "</td>";
                            echo "<td>" . $row["special_requests"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='no-requests'>No requests found</td></tr>";
                    }
                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>@Event Planner and Booking Management System by Concillo & Rabutin FDS A.Y. 2024 All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            sidebar.style.display = (sidebar.style.display === "none") ? "block" : "none";
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

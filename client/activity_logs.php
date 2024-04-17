<?php
// Start the session before any output
session_start();

// Include database connection
include ('connector.php');

// Check if user_id is set in the session
if (isset($_SESSION["user_id"])) {
    // Fetch login logs for a specific user
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT * FROM login_logs WHERE user_id = ? ORDER BY login_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Redirect the user if user_id is not set in the session
    header("Location: login.php");
    exit; // Make sure to exit after redirecting
}
?>

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
            /* Change 'Your-Desired-Font' to the name of your desired font */
            margin: 0;
            padding: 0;
            background-color: grey;
            background-size: cover;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        div {
            font-family: 'Arial', sans-serif;
        }

        header {
            background-color: #151A22;
            color: white;
            padding: 10px 20px;
            z-index: 1000;
            /* Ensure the header appears above the sidebar */
        }

        .sidebar {
            position: fixed;
            top: 60px;
            /* Adjusted top position to match header height */
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            /* Dark background color */
            color: white;
            /* Text color */
            padding-top: 20px;
            /* Adjusted padding */
            overflow-y: auto;
            z-index: 100;
            display: none;
            margin-left: 1200px;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            /* Adjusted padding */
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #555;
            /* Hover background color */
        }

        /* Style for the navbar brand */
        .navbar-brand {
            font-size: 1.5rem;
            margin-left: 20px;
        }

        /* Style for active sidebar link */
        .sidebar a.active {
            background-color: #555 !important;
        }

        .navbar .sub-links.active {
            display: block;
            margin-left: 1100px;
        }

        .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0;
            color: white;
        }

        footer {
            background-color: #f9f9f9;
            padding: 20px 0;
            text-align: center;
            margin-top: 800px;
            border-radius: 0 0 8px 8px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        /* Style for the table */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style for table head */
        .table thead th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            color: #f3f0e6;
        }

        /* Style for table body */
        .table tbody td {
            padding: 12px;
        }

        /* Style for alternating rows */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        /* Style for no-logs message */
        .no-logs {
            text-align: center;
            color: #777;
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
                        <a href="index.php"><i class="fas fa-home"></i>Home</a>

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
        <table class="table">
            <thead>
                <tr>
                    <th>Login Time</th>
                    <th>User ID</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["login_time"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='no-logs'>No login logs found for this user</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
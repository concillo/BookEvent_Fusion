<?php
session_start();
include ('connector.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get username from the session
$username = $_SESSION['username'];

// Get user data from the database
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username); // Corrected data type to "s" for string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Fetch user data and assign it to $user variable
    $user = $result->fetch_assoc();

    // Retrieve booked data for the logged-in user
    $sql_bookings = "SELECT * FROM bookings WHERE username = ?";
    $stmt_bookings = $conn->prepare($sql_bookings);
    $stmt_bookings->bind_param("s", $username); // Corrected data type to "s" for string
    $stmt_bookings->execute();
    $result_bookings = $stmt_bookings->get_result();
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
                margin: 0;
                padding: 0;
                background-color: #465048;
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

            .container2 {
                margin-top: 20px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .table thead th {
                background-color: #343a40;
                color: white;
                font-weight: bold;
                text-align: left;
                border-top: none;
                border-bottom: 2px solid #dee2e6;
            }

            .table tbody tr {
                background-color: #f8f9fa;
            }

            .table tbody tr:hover {
                background-color: #e9ecef;
            }

            .table td,
            .table th {
                padding: 12px;
                vertical-align: middle;
                border-top: none;
                border-bottom: 1px solid #dee2e6;
            }

            /* Optional: Add alternating row colors */
            .table tbody tr:nth-child(even) {
                background-color: #ffffff;
            }

            header {
                background-color: #151A22;
                color: white;
                padding: 10px 20px;
                z-index: 1000;
                /* Ensure the header appears above the sidebar */
                width: 100%;
                top: 0;
            }


            .sidebar {
                position: fixed;
                top: 60px;
                /* Adjusted top position to match header height */
                left: 0;
                width: 250px;
                height: 50%;
                background-color: #333;
                /* Dark background color */
                color: white;
                /* Text color */
                padding-top: 20px;
                /* Adjusted padding */
                overflow-y: auto;
                z-index: 100;
                display: none;
                margin-left: 1100px;
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

            /* Style for the navbar brand */
            .navbar-brand {
                font-size: 1.5rem;
                margin-left: 20px;
            }

            /* Style for sidebar icons */
            .sidebar i {
                margin-right: 10px;
            }

            /* Style for active sidebar link */
            .sidebar a.active {
                background-color: #555 !important;
            }

            .no-bookings {
                color: red;
                text-align: center;
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

        <div class="container2">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Venue Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Guest Count</th>
                            <th>Message</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_bookings->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo $row['venue_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['full_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['phonenum']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date']; ?>
                                </td>
                                <td>
                                    <?php echo $row['start_time']; ?>
                                </td>
                                <td>
                                    <?php echo $row['end_time']; ?>
                                </td>
                                <td>
                                    <?php echo $row['guest_count']; ?>
                                </td>
                                <td>
                                    <?php echo $row['message']; ?>
                                </td>
                                <td class="status-notification">
                                    <?php
                                    $status = $row['bookingStatus'];
                                    $color = ($status == 'Accepted') ? 'green' : (($status == 'Rejected') ? 'red' : 'black');
                                    echo '<span style="color: ' . $color . ';">' . $status . '</span><br>';
                                    echo $row['adminremark'];
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php if ($result_bookings->num_rows == 0): ?>
                    <p class="no-bookings">No bookings</p>
                <?php endif; ?>
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

    <?php
} else {
    // Handle the case when user data is not found
    echo "User not found";
}
?>
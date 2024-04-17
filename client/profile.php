<?php
session_start();
include ('connector.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Fetch user data and assign it to $user variable
    $user = $result->fetch_assoc();

    // Close the statement
    $stmt->close();
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
                color: black;
                background-size: cover;
                background-color: #f3f0e6;
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
                /* Ensure the header appears above the content */
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
            }

            .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: .5rem;
                padding-left: .5rem;
                color: white;
            }

            .navbar .sub-links.active {
                display: block;

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
                /* Hide the sidebar initially */
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

            .content {
                margin-left: 250px;
                /* Adjusted left margin to accommodate sidebar width */
                padding: 20px;
            }

            footer {
                margin-top: 130px;
                background-color: #f9f9f9;
                padding: 20px 0;
                text-align: center;
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

            img {
                vertical-align: middle;
                border-style: none;
                width: 100px;
                height: 100px;
                /* Set a fixed height to make the images square */
                object-fit: cover;
                /* Ensure the entire image is visible */
                margin-top: 80px;
            }


            .mb-4,
            .my-4 {
                margin-bottom: 1.5rem !important;
                margin-top: 80px;
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
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <div class="profile-pic mb-4">
                        <?php if (!empty($user['pic'])): ?>
                            <img src="../dp/<?php echo $user['pic']; ?>" alt="Profile Picture" class="img-fluid rounded-circle"
                                style="width: 150px; height: 150px;">
                        <?php else: ?>
                            <img src="../dp/default.jpg" alt="Default Profile Picture" class="img-fluid rounded-circle"
                                style="width: 150px; height: 150px;">
                        <?php endif; ?>
                    </div>
                    <div class="user-info">
                        <p><strong></strong>
                            <?php echo isset($user['username']) ? $user['username'] : 'N/A'; ?>
                        </p>
                        <p><strong>:</strong>
                            <?php echo isset($user['email']) ? $user['email'] : 'N/A'; ?>
                        </p>

                    </div>
                </div>
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

// Close the database connection
$conn->close();
?>
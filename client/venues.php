<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Event Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* Change 'Your-Desired-Font' to the name of your desired font */
            margin: 0;
            padding: 0;
            color: white;
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
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }

        .navbar .sub-links {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #333;
            min-width: 250px;
            z-index: 1000;
        }

        .navbar .sub-links a {
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .navbar .sub-links a:hover {
            background-color: #555;
        }

        .navbar .sub-links.active {
            display: block;
            margin-left: 1200px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            margin-left: 20px;
        }

        .navbar i {
            margin-right: 10px;
        }

        .navbar .nav-item.active {
            background-color: #555 !important;
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

        .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0;
            color: white;
        }


        .event-container {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            margin-top: 100px;
            /* Adjust as needed */
        }

        .event-container img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .event-details {
            color: #ffffff;
        }

        .event-details h3 {
            margin-top: 0;
        }

        /* Modal style */
        .modal {
            display: none;
            /* Hide the modal by default */
            position: fixed;
            /* Position the modal */
            z-index: 1;
            /* Set z-index to make sure it appears on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scrolling if needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with transparency */
        }

        .modal-content {
            background-color: #fefefe;
            /* White background */
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Set the width of the modal content */
            max-width: 600px;
            /* Set a maximum width for the modal */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Box shadow */
        }

        /* Close button style */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <span class="navbar-brand">Book Venue Management</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i>Home</a>
                    <div class="sub-links">
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

    <div class="container event-container">
        <?php
        include ('connector.php');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to select all venues
        $sql = "SELECT * FROM venues";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='row'>";
                echo "<div class='col-md-4'>";
                echo "<div class='venue'>";
                echo "<div class='venue-image'>";
                echo "<img src='" . $row["venue_image"] . "' alt='Venue Image'>";
                echo "</div>"; // Closing venue-image div
                echo "</div>"; // Closing venue div
                echo "</div>"; // Closing col-md-4 div
        
                echo "<div class='col-md-8'>";
                echo "<div class='venue'>";
                echo "<div class='venue-details'>";
                echo "<h3>" . $row["venue_name"] . "</h3>";
                echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
                echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
                echo "<p><strong>Contact:</strong> " . $row["contact"] . "</p>";
                echo "<p><strong>Capacity:</strong> " . $row["capacity"] . "</p>";
                echo "<p><strong>Facilities:</strong> " . $row["facilities"] . "</p>";
                echo "<a href='booking.php?id=" . $row['id'] . "' class='btn btn-primary'>Book Now</a>";
                echo "</div>"; // Closing venue-details div
                echo "</div>"; // Closing venue div
                echo "</div>"; // Closing col-md-8 div
                echo "</div>"; // Closing row div
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Booking successful!</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const homeLink = document.querySelector(".navbar .nav-link[href='index.php']");
            const subLinks = document.querySelector(".navbar .sub-links");

            homeLink.addEventListener("click", function (event) {
                event.preventDefault();
                subLinks.classList.toggle("active");
            });
        });
    </script>
    <script>
        // Check if session variable indicating successful booking exists
        <?php
        if (isset($_SESSION['booking_success']) && $_SESSION['booking_success'] === true) {
            // If booking success session variable exists, display modal
            echo 'document.getElementById("successModal").style.display = "block";';
            // Unset the session variable after displaying the modal
            unset($_SESSION['booking_success']);
        }
        ?>

        // Get the close button for the modal
        var closeBtn = document.getElementsByClassName("close")[0];

        // Close the modal when the close button is clicked
        closeBtn.onclick = function () {
            document.getElementById("successModal").style.display = "none";
        }
    </script>
    <footer class="footer">
        <div class="container">
            <p>@Restaurant Event Planner by Your Restaurant Name 2024 All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
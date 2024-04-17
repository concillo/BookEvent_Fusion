<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Event Planner</title>
    <link rel="website icon" type="jpg" href="images/logo.jpg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* Change 'Your-Desired-Font' to the name of your desired font */
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
            background-color: #343a40;
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
            background-color: #495057;
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
            background-color: #495057 !important;
        }

        footer {
            background-color: whitesmoke;
            padding: 20px 0;
            text-align: center;
            margin-top: 800px;
            border-radius: 0 0 8px 8px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            color: black;
        }

        .event-container {
            background-color: #f3f0e6;
            border-radius: 8px;
            margin-top: 100px;
            padding: 20px;
        }

        .event-container .venue {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
        }

        .event-container .venue img {
            width: 100%;
            border-radius: 8px;
        }

        .event-container .venue-details h3 {
            color: #343a40;
        }

        .event-container .venue-details p {
            color: #666;
        }

        .event-container .venue-details a {
            color: #fff;
        }

        .fas.fa-star {
            color: yellow;
        }

        b,
        strong {
            font-weight: bolder;
            color: black;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <span class="navbar-brand">Booking Venue Management</span>
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
        include ('connector.php'); // Include the file to connect to your database
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to select all venues with their average ratings
        $sql = "SELECT v.*, AVG(r.rating) AS avg_rating
        FROM venues v
        LEFT JOIN reviews r ON v.id = r.venue_id
        GROUP BY v.id
        ORDER BY avg_rating DESC"; // Sort by average rating in descending order (highest to lowest)
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='row'>";
                echo "<div class='col-md-4'>";
                echo "<div class='venue'>";
                echo "<div class='venue-image'>";
                echo "<img src='" . $row["venue_image"] . "' alt='Venue Image'>";
                echo "<p><strong></strong> " . generateStarRating(round($row['avg_rating'], 1)) . " " . round($row['avg_rating'], 1) . " out of 5</p>"; // Display average rating
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

                // Display comments from reviews table
                echo "<div class='reviews'>";
                echo "<h4>Reviews:</h4>";
                $reviewSql = "SELECT * FROM reviews WHERE venue_id = " . $row['id'];
                $reviewResult = $conn->query($reviewSql);
                if ($reviewResult->num_rows > 0) {
                    while ($reviewRow = $reviewResult->fetch_assoc()) {
                        echo "<p><strong></strong> " . generateStarRating($reviewRow['rating']) . "</p>"; // Display individual ratings as stars
                        echo "<p><strong>Comment:</strong> " . $reviewRow['comment'] . "</p>";
                    }
                } else {
                    echo "<p>No reviews yet.</p>";
                }
                echo "</div>"; // Closing reviews div
        
                echo "</div>"; // Closing venue-details div
                echo "</div>"; // Closing venue div
                echo "</div>"; // Closing col-md-8 div
                echo "</div>"; // Closing row div
            }
        } else {
            echo "0 results";
        }
        $conn->close();

        // Function to generate star rating HTML based on numerical rating
        function generateStarRating($rating)
        {
            $stars = "";
            $fullStars = floor($rating);
            $halfStars = ceil($rating - $fullStars);
            $emptyStars = 5 - $fullStars - $halfStars;

            for ($i = 0; $i < $fullStars; $i++) {
                $stars .= "<i class='fas fa-star'></i>";
            }

            if ($halfStars > 0) {
                $stars .= "<i class='fas fa-star-half-alt'></i>";
            }

            for ($i = 0; $i < $emptyStars; $i++) {
                $stars .= "<i class='far fa-star'></i>";
            }

            return $stars;
        }
        ?>


    </div>

    <footer class="footer">
        <div class="container">
            <p>@Rating Event Planner by Your Restaurant Name 2024 All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navLinks = document.querySelectorAll(".nav-link");

            navLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent the default behavior of the link
                    const subLinks = this.nextElementSibling;
                    if (subLinks.classList.contains('sub-links')) {
                        subLinks.classList.toggle('active');
                    }
                });
            });
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
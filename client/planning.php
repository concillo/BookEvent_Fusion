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
            background-color: black;
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


        .container2 {
            max-width: 600px;
            /* Adjust width if needed */
            margin: 50px auto;
            /* Adjust margin if needed */
            background-color: rgba(255, 255, 255, 0.9);
            /* Adjust background color and opacity */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            /* Adjust box shadow */
        }

        .container2 h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            /* Adjust heading color */
        }

        .container2 form {
            /* Add any additional styling for the form */
        }

        .container2 label {
            font-weight: bold;
            /* Add any additional styling for labels */
        }

        .container2 input[type="text"],
        .container2 input[type="date"],
        .container2 input[type="time"],
        .container2 select,
        .container2 input[type="number"] {
            width: calc(100% - 24px);
            /* Adjust input width to fit container */
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .container2 select {
            height: 40px;
            /* Add any additional styling for selects */
        }

        .container2 input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .container2 input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .container2 .form-group {
            margin-bottom: 30px;
        }

        .container2 .form-group label {
            display: block;
            margin-bottom: 5px;
        }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

     
        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select,
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        select {
            height: 40px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
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
    <h2>Event Request Form</h2>
    <form action="requests.php" method="post">
        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type" required>
            <option value="wedding">Wedding</option>
            <option value="birthday">Birthday</option>
            <option value="corporate">Corporate</option>
            <option value="other">Other</option>
        </select>

        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required>

            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>

            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required>

        <label for="venue">Venue:</label>
        <select id="venue" name="venue" required>
            <option value="Dining Area">Dining Area</option>
            <option value="Bar">Bar</option>
            <option value="Outdoor Patio">Outdoor Patio</option>
            <option value="Private Dining Room">Private Dining Room</option>
            <option value="Lounge">Lounge</option>
            <option value="Chef's Table">Chef's Table</option>
            <option value="Terrace">Terrace</option>
            <option value="Function Room">Function Room</option>
            <option value="Cocktail Area">Cocktail Area</option>
            <option value="Coffee Bar">Coffee Bar</option>
        </select>

        <label for="ambiance">Ambiance:</label>
        <select id="ambiance" name="ambiance" required>
            <option value="ef">Elegant/Formal</option>
            <option value="wf ">Whimsical/Fantasy </option>
            <option value="ct">Cultural/Traditional</option>
            <option value="ie">Interactive/Engaging</option>
            <option value="pdr">Private Dining Room</option>
            <option value="cp">Corporate/Professional</option>
            <option value="tm">Theme-Based</option>
            <option value="r">Romantic</option>
            <option value="mc">Modern/Contemporary</option>
            <option value="rn">Rustic/Natural</option>
            <option value="cr">Casual/Relaxed</option>
        </select>

            <label for="guest_count">Guest Count:</label>
            <input type="number" id="guest_count" name="guest_count" required>

        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget" required>

        <label for="special_requests">Special Requests:</label>
        <input type="text" id="special_requests" name="special_requests" required>

        <input type="submit" value="Submit">
    </form>
</div>
            <label for="budget">Budget:</label>
            <input type="number" id="budget" name="budget" required>


            <label for="special_requests">Special Requests:</label>
            <input type="text" id="special_requests" name="special_requests" required>

            <input type="submit" value="Submit">
        </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('event_request_form');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                alert('Event request submitted successfully!');

                window.location.href = 'index.php';
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
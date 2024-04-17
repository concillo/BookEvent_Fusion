<?php
session_start();

// Initialize $venue_id using $_GET
$venue_id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];
} else {
    exit();
}

// Include your database connection file
include ('connector.php');

// Query to fetch all venue names and IDs from the 'venues' table
$sqlVenues = "SELECT venue_id, venue_name FROM venues";
$resultVenues = $conn->query($sqlVenues);

// Array to store all venue names and IDs
$venues = array();

// Fetching venue names and IDs and adding them to the array
if ($resultVenues->num_rows > 0) {
    while ($row = $resultVenues->fetch_assoc()) {
        $venues[$row['venue_id']] = $row['venue_name'];
        // If venue_id matches the one in URL parameters, set the corresponding venue_name
        if ($row['venue_id'] == $venue_id) {
            $venue_name = $row['venue_name'];
        }
    }
}

// Close the database connection
$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the form
    $venue_id = $_POST['venue_id'];
    $venue_name = $_POST['venue_name'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $guest_count = $_POST['guest_count'];
    $message = $_POST['message'];

    include ('connector.php');

    // Prepare and execute the SQL query to insert booking details into the database
    $sql = "INSERT INTO bookings (venue_id, venue_name, full_name, email, phonenum, date, start_time, end_time, guest_count, message, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit();
    }
    $stmt->bind_param("isssissssss", $venue_id, $venue_name, $name, $email, $phonenum, $date, $start_time, $end_time, $guest_count, $message, $loggedInUsername);

    if ($stmt->execute()) {
        $_SESSION['booking_success'] = true;
        header("Location: venues.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: calc(100% - 20px);
            /* Adjusting width for border and padding */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            /* Allow vertical resizing */
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logo {
            background-color: grey;
            text-align: center;
            color: #333;
            padding: 30px;
            /* Adjust the padding as desired */
            margin-bottom: 10px;
            /* Adjust the margin as desired */
            border-radius: 8px;
        }

        footer {
            background-color: #f9f9f9;
            padding: 20px 0;
            text-align: center;
            margin-top: 80px;
            border-radius: 0 0 8px 8px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        /* Modal */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1000;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
            border-radius: 8px;
        }

        /* Close Button */
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

        /* Error message */
        .error {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h1 class="logo"></h1>
    <div class="container">
        <h2>Book Venue</h2>
        <form id="bookingForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            onsubmit="return validateForm()">
            <!-- Add a hidden input field to store the venue_id -->
            <input type="hidden" name="venue_id" value="<?php echo htmlspecialchars($venue_id); ?>">


            <label for="venue_name">Venue Name:</label>
            <select id="venue_name" name="venue_name" required>
                <option value="">Select Venue</option>
                <?php foreach ($venues as $venue): ?>
                    <option value="<?php echo htmlspecialchars($venue); ?>">
                        <?php echo htmlspecialchars($venue); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>

            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required>

            <label for="guest_count">Number of Guests:</label>
            <input type="number" id="guest_count" name="guest_count" required>

            <label for="message">Special Requests:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phonenum">Phone Number:</label>
            <input type="tel" id="phonenum" name="phonenum" required>

            <input type="submit" id="bookNowBtn" value="Book Now">
            <div id="errorMessage" class="error"></div>
        </form>
    </div>

    <!-- Main modal for booking confirmation -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="confirmationMessage">Do you really want to book this venue?</p>
            <!-- Changed button id to trigger booking -->
            <button id="confirmBookingBtn">Yes</button>
            <button id="cancelBookingBtn">Cancel</button>
        </div>
    </div>

    <!-- Modal for confirmation notification -->
    <div id="confirmationModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="confirmationNotification">Got it! Wait for the confirmation</p>
        </div>
    </div>

    <script>
        // Get references to DOM elements
        // Get references to DOM elements
        var mainModal = document.getElementById("myModal");
        var confirmationModal = document.getElementById("confirmationModal");
        var bookNowBtn = document.getElementById("bookNowBtn");
        var span = document.getElementsByClassName("close");

        // When the user clicks on <span> (x) or Cancel, close the modals
        for (var i = 0; i < span.length; i++) {
            span[i].onclick = function () {
                mainModal.style.display = "none";
                confirmationModal.style.display = "none";
            };
        }

        // When the user clicks on Yes, show confirmation modal and submit the form
        document.getElementById("confirmBookingBtn").onclick = function () {
            // Close the main modal
            mainModal.style.display = "none";
            // Show the confirmation modal
            confirmationModal.style.display = "block";

            // Trigger the form submission after confirmation
            document.getElementById("bookingForm").submit();
        };

        // When the user clicks the button, open the main modal if form is valid
        bookNowBtn.onclick = function (event) {
            // Prevent default form submission
            event.preventDefault();

            // Check if the form is valid
            if (validateForm()) {
                mainModal.style.display = "block";
            }
        };

        // Function to validate the form before submission
        // Function to validate the form before submission
        function validateForm() {
            var name = document.getElementById("full_name").value;
            var email = document.getElementById("email").value;
            var phonenum = document.getElementById("phonenum").value;
            var date = document.getElementById("date").value;
            var start_time = document.getElementById("start_time").value;
            var end_time = document.getElementById("end_time").value;
            var guest_count = document.getElementById("guest_count").value;
            var message = document.getElementById("message").value;

            // Check if any of the fields are empty
            if (name === "" || email === "" || phonenum === "" || date === "" || start_time === "" || end_time === "" || guest_count === "" || message === "") {
                alert("Please fill out all fields before submitting.");
                return false;
            }

            // If all fields are filled, return true
            return true;
        }
    </script>
</body>

</html>
<?php
// Start session
session_start();

// Database connection parameters
include ('connector.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is set in session
if (!isset($_SESSION['user_id'])) {
    die("User ID is not set in session.");
}

// Retrieve user ID from session
$userId = $_SESSION['user_id'];
echo "User ID from session: $userId<br>";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $date = mysqli_real_escape_string($conn, $_POST["event_date"]);
    $startTime = mysqli_real_escape_string($conn, $_POST["start_time"]);
    $endTime = mysqli_real_escape_string($conn, $_POST["end_time"]);
    $eventType = mysqli_real_escape_string($conn, $_POST["event_type"]);
    $eventStyle = mysqli_real_escape_string($conn, $_POST["event_style"]);
    $guestCount = mysqli_real_escape_string($conn, $_POST["guest_count"]);
    $preferredCuisine = mysqli_real_escape_string($conn, $_POST["preferred_cuisine"]);
    $budget = mysqli_real_escape_string($conn, $_POST["budget"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $ambiance = mysqli_real_escape_string($conn, $_POST["ambiance"]);
    $alcohol = mysqli_real_escape_string($conn, $_POST["alcohol_and_beverage"]);
    $specialRequest = mysqli_real_escape_string($conn, $_POST["special_requests"]);

    // Validate numeric fields
    if (!is_numeric($guestCount) || !is_numeric($budget)) {
        die("Guest count and budget must be numeric values.");
    }

    // Prepare and execute SQL statement
    $sql = "INSERT INTO user_requests (user_id, event_date, start_time, end_time, event_type, event_style, guest_count, preferred_cuisine, budget, location, ambiance, alcohol_and_beverage, special_requests) VALUES ('$userId', '$date', '$startTime', '$endTime', '$eventType', '$eventStyle', '$guestCount', '$preferredCuisine', '$budget', '$location', '$ambiance', '$alcohol', '$specialRequest')";

    if ($conn->query($sql) === TRUE) {
        echo "Event preferences submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No data received from the form.";
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Restaurant Preferences</title>
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Heading styles */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        /* Form styles */
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>') no-repeat right center;
            background-size: 25px;
            padding-right: 30px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Event Restaurant Preferences</h1>

        <!-- Event Preferences Form -->
        <form id="eventPreferencesForm" method="post">
            <label for="date">Event Date:</label>
            <input type="date" id="date" name="event_date" required>

            <label for="startTime">Start Time:</label>
            <input type="time" id="startTime" name="start_time" required>

            <label for="endTime">End Time:</label>
            <input type="time" id="endTime" name="end_time" required>

            <label for="eventType">Type of Event:</label>
            <select id="eventType" name="event_type" required>
                <option value="">Select Event Type</option>
                <option value="wedding">Wedding</option>
                <option value="birthday">Birthday Party</option>
                <option value="corporate">Corporate Event</option>
                <option value="other">Other</option>
            </select>

            <label for="eventStyle">Formal or Casual:</label>
            <input type="text" id="eventStyle" name="event_style" placeholder="Formal or Casual" required>

            <label for="guestCount">Number of Guests:</label>
            <input type="number" id="guestCount" name="guest_count" min="1" required>

            <label for="preferredCuisine">Preferred Cuisine:</label>
            <select id="preferredCuisine" name="preferred_cuisine" required>
                <option value="">Select Preferred Cuisine</option>
                <option value="italian">Italian</option>
                <option value="mexican">Mexican</option>
                <option value="chinese">Chinese</option>
                <option value="american">American</option>
                <option value="other">Other</option>
            </select>

            <label for="budget">Budget:</label>
            <input type="number" id="budget" name="budget" placeholder="Enter Budget" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter Location" required>

            <label for="ambiance">Ambiance:</label>
            <select id="ambiance" name="ambiance" required>
                <option value="">Select Ambiance</option>
                <option value="cozy">Cozy</option>
                <option value="elegant">Elegant</option>
                <option value="lively">Lively</option>
                <option value="modern">Modern</option>
                <option value="other">Other</option>
            </select>

            <label for="alcohol">Alcohol and Beverage:</label>
            <textarea id="alcohol" name="alcohol_and_beverage" placeholder="Alcohol and Beverage Preferences"
                required></textarea>

            <label for="specialRequest">Special Requests:</label>
            <textarea id="specialRequest" name="special_requests" placeholder="Special Requests" required></textarea>

            <!-- Add a hidden input field for user_id -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

            <input type="submit" value="Submit Preferences">
        </form>
    </div>
</body>

</html>
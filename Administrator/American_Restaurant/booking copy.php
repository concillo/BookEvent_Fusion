<?php
session_start();

if(isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];
} else {
   exit(); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $venueId = $_POST['venue_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $guestCount = $_POST['guest_count'];
    $message = $_POST['message'];

    include('connector.php');

    $sql = "INSERT INTO bookings (venue_id, name, email, date, guest_count, message, username) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssiss", $venueId, $name, $email, $date, $guestCount, $message, $loggedInUsername);

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
            font-family: 'Libre Baskerville', serif; 
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
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
            width: calc(100% - 20px); /* Adjusting width for border and padding */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical; /* Allow vertical resizing */
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
            padding: 30px; /* Adjust the padding as desired */
            margin-bottom: 10px; /* Adjust the margin as desired */
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
        .navbar .sub-links.active {
    display: block;
    margin-left: 1100px;
}
    </style>
</head>
<body>
    <h1 class="logo">Event Management System</h1>
    <div class="container">
        <h2>Book Venue</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Add a hidden input field to store the venue_id -->
            <input type="hidden" name="venue_id" value="<?php echo $_GET['id']; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="guest_count">Number of Guests:</label>
            <input type="number" id="guest_count" name="guest_count" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <input type="submit" value="Book Now">
        </form>
    </div>

    <footer>
        <p>&copy; Event Planner and Booking Management System by Concillo & Rabutin FDS A.Y. 2024 <span>All Rights Reserved.</span></p>
    </footer>
</body>
</html>

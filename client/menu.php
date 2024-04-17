<?php
include('connector.php');
session_start();
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the previous ID from the user_requests table
    $sql_previous_id = "SELECT id FROM user_requests ORDER BY id DESC LIMIT 1";
    $result_previous_id = $conn->query($sql_previous_id);
    if ($result_previous_id->num_rows > 0) {
        $row = $result_previous_id->fetch_assoc();
        $user_request_id = $row["id"];
    } else {
        // If no previous ID found, handle accordingly
        echo "Error: No previous ID found";
        exit;
    }
    
    $dishes = mysqli_real_escape_string($conn, $_POST['dishes']);
    $drinks = mysqli_real_escape_string($conn, $_POST['drinks']);
    $clarify = mysqli_real_escape_string($conn, $_POST['clarify']);

    $sql = "INSERT INTO menu_req (user_id, user_request_id, dishes, drinks, clarify)
            VALUES ('$user_id', '$user_request_id', '$dishes', '$drinks', '$clarify')";

    if ($conn->query($sql) === TRUE) {
        header("Location: myrequest.php");
        exit; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
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
        font-family: 'Libre Baskerville', serif;
        margin: 0;
        padding: 0;
        background-image: url('../images/profile.jpg');
        background-size: cover;
    }

    header {
        background-color: black;
        color: white;
        padding: 10px 20px;
        z-index: 1000; /* Ensure the header appears above the sidebar */
    }

    .sidebar {
        position: fixed;
        top: 60px; /* Adjusted top position to match header height */
        left: 0;
        width: 250px;
        height: 50%;
        background-color: #333; /* Dark background color */
        color: white; /* Text color */
        padding-top: 20px; /* Adjusted padding */
        overflow-y: auto;
        z-index: 100;
        display: none; /* Hide the sidebar initially */
    }

    .sidebar a {
        display: block;
        padding: 10px 20px; /* Adjusted padding */
        color: white;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #555; /* Hover background color */
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
        max-width: 800px; /* Adjust width if needed */
        margin: 50px auto; /* Adjust margin if needed */
        background-color: rgba(255, 255, 255, 0.9); /* Adjust background color and opacity */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Adjust box shadow */
    }

    .container2 h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333; /* Adjust heading color */
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
        width: calc(100% - 24px); /* Adjust input width to fit container */
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
</style>

</head>

<body>
<header class="header">
    <nav class="navbar navbar-expand-lg">
        <span class="navbar-brand">Booking Event Management</span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="toggleSidebar()"><i class="fas fa-home"></i>Home</a>
                <div class="sidebar" id="sidebar">
                    <a href="venues.php"><i class="fas fa-map-marker-alt"></i>Find Event</a>
                    <a href="planning.php"><i class="fas fa-calendar-plus"></i>Create Events</a>
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
    <h2>Menu's</h2>
    <form action="menu.php" method="post">
    <input type="hidden" name="user_request_id" value="<?php echo $_GET['id']; ?>">

       <label for="dishes">Dishes:</label>
        <select id="dishes" name="dishes" required>
            <option value="desserts">Desserts</option>
            <option value="appetizers">Appetizers</option>
            <option value="soupsalads">Soup and Salad</option>
             <option value="entrees">Entrees</option>
            <option value="burgersandwich">Burger and Sandwich</option>
        </select>
       
        <label for="drinks">Drinks:</label>
<select id="drinks" name="drinks" required>
    <option value="non-alcoholic">Non-Alcoholic</option>
    <option value="alcoholic">Alcoholic</option>
    <option value="coffee">Coffee</option>
 </select>

         <label for="clarify">Clarrification:</label>
        <input type="text" id="clarify" name="clarify" required>

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
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('event_request_form');

        form.addEventListener('submit', function(event) {
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

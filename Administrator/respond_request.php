<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel - Respond to Request</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>   
  body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 100px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center the items horizontally */
            gap: 20px; /* Add spacing between the items */
        }

    header {
        background-color: saddlebrown;
        color: white;
        padding: 10px 20px;
        z-index: 1000; /* Ensure the header appears above the sidebar */
    }

    .sidebar {
        position: fixed;
        top: 60px; /* Adjusted top position to match header height */
        left: 0;
        width: 250px;
        height: 100%;
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
 
    /* Style for sidebar icons */
    .sidebar i {
        margin-right: 10px;
    }

    /* Style for active sidebar link */
    .sidebar a.active {
        background-color: #555 !important;
    }
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Event Management</a>
        <div class="ml-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Venues</a>
                </li>
                <li class="nav-item">
                 <a class= "nav-link" href="../login.php"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container">
    <h2>Respond to Request</h2>
    <?php
    include('connector.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $request_id = $_POST['request_id'];
        $response = mysqli_real_escape_string($conn, $_POST['response']);
        $sql = "UPDATE user_requests SET admin_response = '$response' WHERE id = $request_id";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Response submitted successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }
    }

    if (isset($_GET['id'])) {
        $request_id = $_GET['id'];
        $sql = "SELECT * FROM user_requests WHERE id = $request_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
        <div class="form-group">
            <label for="response">Admin Response:</label>
            <select name="response" id="response" class="form-control" required>
                                    <option value="Approved">Approved</option>
                                    <option value="Refused">Refused</option>
                                   </div>
        </select>
        <button type="submit" class="btn btn-primary">Submit Response</button>
    </form>
    <?php
        } else {
            echo '<div class="alert alert-warning" role="alert">No request found with the provided ID.</div>';
        }
    } 
    $conn->close();
    ?>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

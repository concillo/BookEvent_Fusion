<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your CSS styles here */
        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        <style>.venue-table {
            width: 100%;
            border-collapse: collapse;
        }

        .venue-table th,
        .venue-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .venue-table img {
            max-width: 100px;
            height: auto;
        }

        .add-venue-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Event Management</a>
        <div class="ml-auto">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="event.php">Venues Available</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Events</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    
    include('../connector.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
$sql = "SELECT * FROM venues";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='venue-table'>";
        echo "<tr></th><th>Venue Name</th><th>Image</th><th>Description</th><th>Location</th><th>Contact</th><th>Capacity</th><th>Facilities</th><th>Actions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["venue_name"] . "</td>";
            echo "<td><img src='" . $row["venue_image"] . "' alt='Venue Image'></td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["location"] . "</td>";
            echo "<td>" . $row["contact"] . "</td>";
            echo "<td>" . $row["capacity"] . "</td>";
            echo "<td>" . $row["facilities"] . "</td>";
            echo "<td><a href='update_venue.php?id=" . $row["id"] . "'>Update</a> | <a href='delete_venue.php?id=" . $row["id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <button class="add-venue-btn" onclick="location.href='add_venues.php';">Add Venue</button>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venues</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        .navbar {
            height: 60px !important;
            background-color: black !important;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .container {
            margin-top: 20px;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            background-image: linear-gradient(to bottom, #007bff, #0056b3);
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        .view-details {
            color: #007bff;
            text-decoration: none;
        }

        .view-details:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->

    <?php
    // Include your database connection script
    include ('../../connector.php');

    // Function to delete all bookings
    function deleteAllBookings($conn)
    {
        $sql = "DELETE FROM bookings WHERE username IN (SELECT username FROM users WHERE store = 'American')"; // Modify the query to delete bookings only from the American store
        if ($conn->query($sql) === TRUE) {
            echo "All bookings from the American store deleted successfully";
        } else {
            echo "Error deleting bookings: " . $conn->error;
        }
    }

    // Check if the delete all button is clicked
    if (isset($_POST['delete_all'])) {
        deleteAllBookings($conn);
    }

    // Query to retrieve booking information from the American store
    $sql = "SELECT b.* FROM bookings b JOIN users u ON b.username = u.username WHERE u.store = 'American'";
    $result = $conn->query($sql);

    // Check if there are any bookings
    if ($result->num_rows > 0) {
        // Display a table header
        echo "<form method='post'>";
        echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Phone Number</th>
            </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["full_name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["date"] . "</td>
                <td>" . $row["phonenum"] . "</td>
                <td><a href='../booking_details.php?id=" . $row["id"] . "'>View Details</a></td> <!-- View Details button -->
              </tr>";
        }
        echo "</table>";
        echo "</form>";
    } else {
        echo "No bookings from the American store found";
    }

    // Close the database connection
    $conn->close();
    ?>

</body>

</html>
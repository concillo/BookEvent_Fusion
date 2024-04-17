<!DOCTYPE html>
<html>
<head>
    <title>Delete All Bookings</title>
    <style>
        body {
            font-family: 'Libre Baskerville', serif; /* Change font-family to Libre Baskerville */
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Include your database connection script
include('../connector.php');

// Function to delete all bookings
function deleteAllBookings($conn) {
    $sql = "DELETE FROM bookings WHERE username IN (SELECT username FROM users WHERE store = 'Mediterranean')"; // Modify the query to delete bookings only from the American store
    if ($conn->query($sql) === TRUE) {
        echo "All bookings from the Mediterranean store deleted successfully";
    } else {
        echo "Error deleting bookings: " . $conn->error;
    }
}

// Check if the delete all button is clicked
if (isset($_POST['delete_all'])) {
    deleteAllBookings($conn);
}

// Query to retrieve booking information from the American store
$sql = "SELECT b.* FROM bookings b JOIN users u ON b.username = u.username WHERE u.store = 'Mediterranean'";
$result = $conn->query($sql);

// Check if there are any bookings
if ($result->num_rows > 0) {
    // Display a table header
    echo "<form method='post'>";
    echo "<table border='1'>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Guest Count</th>
                <th>Message</th>
                <th>Action</th> <!-- New column for action -->
                <th>Delete All</th> <!-- New column for delete button -->
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["date"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["guest_count"]."</td>
                <td>".$row["message"]."</td>
                <td><a href='booking_details.php?id=".$row["id"]."'>View Details</a></td> <!-- View Details button -->
              </tr>";
    }
    echo "<tr><td colspan='6'></td><td><input type='submit' name='delete_all' value='Delete All'></td></tr>";
    echo "</table>";
    echo "</form>";
} else {
    echo "No bookings from the Mediterranean store found";
}

// Close the database connection
$conn->close();
?>

</body>
</html>

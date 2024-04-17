<!DOCTYPE html>
<html>
<head>
    <title>Delete All Bookings</title>
    <style>
        body {
            font-family: 'Libre Baskerville', serif; 
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
        

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
    </style>
</head>
<body>

<div id="pageContent">
 </div>

<script>
    function loadPage(page) {
        fetch(page)
            .then(response => response.text())
            .then(data => {
                document.getElementById('pageContent').innerHTML = data;
            });
    }
</script>

<?php
include('../connector.php');

function deleteAllBookings($conn) {
    $sql = "DELETE FROM bookings WHERE username IN (SELECT username FROM users WHERE store = 'Italian')"; // Modify the query to delete bookings only from the American store
    if ($conn->query($sql) === TRUE) {
        echo "All bookings from the Italian store deleted successfully";
    } else {
        echo "Error deleting bookings: " . $conn->error;
    }
}

if (isset($_POST['delete_all'])) {
    deleteAllBookings($conn);
}

$sql = "SELECT b.* FROM bookings b JOIN users u ON b.username = u.username WHERE u.store = 'Italian'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post'>";
    echo "<table border='1'>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Guest Count</th>
                <th>Message</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["date"]."</td>
                <td>".$row["full_name"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["guest_count"]."</td>
                <td>".$row["message"]."</td>
                <td><a href='../booking_details.php?id=".$row["id"]."'>View Details</a></td> <!-- View Details button -->
              </tr>";
    }
    echo "<tr><td colspan='6'></td><td><input type='submit' name='delete_all' value='Delete All'></td></tr>";
    echo "</table>";
    echo "</form>";
} else {
    echo "No bookings from the Italian store found";
}


// Close the database connection
$conn->close();
?>

</body>
</html>

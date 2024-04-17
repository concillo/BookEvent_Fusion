<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Dashboard</title>
</head>
<body>
    <h2>Requested Deliveries</h2>
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch incoming messages from event planner admin (assuming stored in a database)
        // Replace this with your actual database connection and query
        include('connector.php');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch incoming messages from the database
        $sql = "SELECT message_id, message_subject, message_content FROM incoming_messages";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["message_subject"] . "</td>";
                echo "<td>" . $row["message_content"] . "</td>";
                // Check if the delivery request has been accepted or declined
                $status = getDeliveryStatus($row["message_id"]); // Function to retrieve delivery status
                echo "<td>$status</td>";
                echo "<td>";
                if ($status == "Accepted") {
                    echo "<a href='delivery_details_form.php?message_id=" . $row["message_id"] . "'>Provide Delivery Details</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No incoming messages.</td></tr>";
        }
        $conn->close();
        
        // Function to retrieve delivery status based on message ID
        function getDeliveryStatus($message_id) {
            // Implement your logic to retrieve the delivery status from the database
            // For demonstration purposes, let's assume status is retrieved from another table
            return "Accepted"; // Replace with actual status retrieval logic
        }
        ?>
    </table>
</body>
</html>

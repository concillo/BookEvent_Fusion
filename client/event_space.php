<?php
// Connect to MySQL database
include('connector.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query event spaces
$sql = "SELECT * FROM event_spaces";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Event Space: " . $row["name"] . "<br>";
        echo "Capacity: " . $row["capacity"] . "<br>";
        echo "Available Dates: " . "<br>";
        $available_dates = json_decode($row["available_dates"], true);
        foreach ($available_dates as $date => $available) {
            echo "- " . $date . ": " . ($available ? "Available" : "Not Available") . "<br>";
        }
        echo "Available Times: " . "<br>";
        $available_times = json_decode($row["available_times"], true);
        foreach ($available_times as $date => $times) {
            echo "- " . $date . ": " . implode(", ", $times) . "<br>";
        }
        echo "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!-- search_results.php -->
<?php
// Include database connection
include 'connector.php';

// Get search parameters from the form
$serviceType = $_GET['service_type'];

// Query to search for vendors based on service type
$sql = "SELECT * FROM vendors WHERE type = '$serviceType'";
$result = $conn->query($sql);

// Display search results
if ($result->num_rows > 0) {
    echo "<h2>Search Results</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>Name: " . $row['name'] . "<br>";
        echo "Contact: " . $row['contact'] . "<br>";
        echo "Services Offered: " . $row['services_offered'] . "</p>";
    }
} else {
    echo "<p>No vendors found.</p>";
}

// Close database connection
$conn->close();
?>

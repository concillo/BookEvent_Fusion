<?php
// Database connection parameters (you can remove this if already included)
include('../connector.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user request ID from the form
    $user_request_id = $_POST['user_request_id'];

    // Get selected foods from the form
    $selected_foods = isset($_POST['food_ids']) ? $_POST['food_ids'] : [];

    // Initialize an array to store food names
    $food_names = [];

    // Fetch names of selected foods from the 'foods' table
    if (!empty($selected_foods)) {
        $food_ids_string = implode(',', $selected_foods);
        $sql_fetch_foods = "SELECT name FROM foods WHERE id IN ($food_ids_string)";
        $result_fetch_foods = $conn->query($sql_fetch_foods);
        if ($result_fetch_foods) {
            if ($result_fetch_foods->num_rows > 0) {
                while ($row = $result_fetch_foods->fetch_assoc()) {
                    $food_names[] = $row['name'];
                }
            }
        } else {
            echo "Error fetching food names: " . $conn->error;
        }
    }

    // Convert array of food names into comma-separated string
    $food_names_string = implode(',', $food_names);

    // Update the booking table with the selected food names
    $sql_update_booking = "UPDATE booking SET foods = CONCAT(foods, ',', '$food_names_string') WHERE user_request_id = $user_request_id";

    if ($conn->query($sql_update_booking) === TRUE) {
        echo "Foods have been successfully inserted into the booking table.";
    } else {
        echo "Error updating booking table: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

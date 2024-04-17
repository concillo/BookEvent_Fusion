<?php
include ('../connector.php');

// Initialize $row variable
$row = [];

// Fetch the venue data based on the ID
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $venue_id = $_GET['id'];
    $sql = "SELECT * FROM venues WHERE id='$venue_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        // Handle error if venue with given ID is not found
        // For example, redirect to an error page or display an error message
        exit("Venue not found");
    }
}

// Update venue when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $venue_name = $_POST['venue_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $capacity = $_POST['capacity'];
    $facilities = $_POST['facilities'];

    // Build the SET clause dynamically based on non-empty values
    $set_clause = "";
    if (!empty($venue_name)) {
        $set_clause .= "venue_name='$venue_name', ";
    }
    if (!empty($description)) {
        $set_clause .= "description='$description', ";
    }
    if (!empty($location)) {
        $set_clause .= "location='$location', ";
    }
    if (!empty($contact)) {
        $set_clause .= "contact='$contact', ";
    }
    if (!empty($capacity)) {
        $set_clause .= "capacity='$capacity', ";
    }
    if (!empty($facilities)) {
        $set_clause .= "facilities='$facilities', ";
    }

    // Remove trailing comma and space from the set_clause
    $set_clause = rtrim($set_clause, ', ');

    $sql = "UPDATE venues SET $set_clause WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "Venue updated successfully";
    } else {
        $errorMessage = "Error updating venue: " . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Venue</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
    <div class="container">
        <h2>Update Venue</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="venue_name" name="venue_name"
                    value="<?php echo isset($row['venue_name']) ? $row['venue_name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description"
                    name="description"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="<?php echo isset($row['location']) ? $row['location'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact"
                    value="<?php echo isset($row['contact']) ? $row['contact'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="text" class="form-control" id="capacity" name="capacity"
                    value="<?php echo isset($row['capacity']) ? $row['capacity'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="facilities">Facilities:</label>
                <textarea class="form-control" id="facilities"
                    name="facilities"><?php echo isset($row['facilities']) ? $row['facilities'] : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
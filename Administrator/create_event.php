<?php
session_start();
include ('../connector.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = clean_input($_POST['venue_name']);
    $description = clean_input($_POST['description']);
    $location = clean_input($_POST['location']);
    $contact = clean_input($_POST['contact']);
    $capacity = clean_input($_POST['capacity']);
    $facilities = clean_input($_POST['facilities']);

    // Process image upload
    if (isset($_FILES['venue_image']) && $_FILES['venue_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['venue_image']['name'];
        $image_tmp_name = $_FILES['venue_image']['tmp_name'];
        $image_type = $_FILES['venue_image']['type'];

        // Validate image type
        $allowed_types = ['image/jpeg', 'image/png']; // Adjust this array as per your allowed image types
        if (in_array($image_type, $allowed_types)) {
            $target_dir = "../venue/";
            $target_file = $target_dir . basename($image_name);
            if (move_uploaded_file($image_tmp_name, $target_file)) {
                // Insert the venue details into the venue table
                $stmt = $conn->prepare("INSERT INTO venue (venue_name, description, location, contact, capacity, facilities, img) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssiss", $name, $description, $location, $contact, $capacity, $facilities, $target_file);

                if ($stmt->execute()) {
                    // Retrieve the ID of the newly inserted venue
                    $venue_id = $stmt->insert_id;

                    // Insert the venue ID into the venues table
                    $stmt = $conn->prepare("INSERT INTO venues (venue_id, venue_name, description, location, contact, capacity, facilities, venue_image) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("isssiss", $venue_id, $name, $description, $location, $contact, $capacity, $facilities, $target_file);

                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = "Venue added successfully";
                    } else {
                        $_SESSION['error_message'] = "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $_SESSION['error_message'] = "Error adding venue: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $_SESSION['error_message'] = "Error moving file to target directory.";
            }
        } else {
            $_SESSION['error_message'] = "Error: Only JPG, JPEG, and PNG files are allowed.";
        }
    } else {
        $_SESSION['error_message'] = "Error uploading file.";
    }
    $conn->close();
}

function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Venue</title>
</head>
<body>
    <h2>Add Venue</h2>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    } elseif (isset($_SESSION['error_message'])) {
        echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <form action="add_venues.php" method="post" enctype="multipart/form-data">
        <label for="venue_name">Venue Name:</label><br>
        <input type="text" id="venue_name" name="venue_name" required><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4"></textarea><br>
        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location"><br>
        <label for="contact">Contact:</label><br>
        <input type="text" id="contact" name="contact"><br>
        <label for="capacity">Capacity:</label><br>
        <input type="number" id="capacity" name="capacity"><br>
        <label for="facilities">Facilities:</label><br>
        <textarea id="facilities" name="facilities" rows="4"></textarea><br>
        <label for="venue_image">Image Upload:</label><br>
        <input type="file" id="venue_image" name="venue_image" required><br> <!-- Adding 'required' attribute to ensure an image is uploaded -->
        <input type="submit" value="Add Venue">
    </form>
</body>
</html>

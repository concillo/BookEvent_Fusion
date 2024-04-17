<?php
session_start();
include ('../connector.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get venue details
    $name = clean_input($_POST['venue_name']);
    $description = clean_input($_POST['description']);
    $location = clean_input($_POST['location']);
    $contact = clean_input($_POST['contact']);
    $capacity = clean_input($_POST['capacity']);
    $facilities = clean_input($_POST['facilities']);
    $venue_id = clean_input($_POST['venue_id']);

    // Process image upload
    if (isset($_FILES['venue_image']) && $_FILES['venue_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['venue_image']['name'];
        $image_tmp_name = $_FILES['venue_image']['tmp_name'];
        $image_type = $_FILES['venue_image']['type'];

        // Validate image type
        $allowed_types = ['image/jpeg', 'image/png'];
        if (in_array($image_type, $allowed_types)) {
            $target_dir = "../venue/";
            $target_file = $target_dir . basename($image_name);
            move_uploaded_file($image_tmp_name, $target_file);

            // Get selected product IDs
            $selected_products = isset($_POST['products']) ? $_POST['products'] : [];
            $product_ids = implode(',', array_map('intval', $selected_products));

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO venues (venue_id, venue_name, description, location, contact, capacity, facilities, venue_image, product_id) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssssi", $venue_id, $name, $description, $location, $contact, $capacity, $facilities, $target_file, $product_ids);
            
            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Venue added successfully";
            } else {
                $_SESSION['error_message'] = "Error: " . $stmt->error;
            }
        } else {
            $_SESSION['error_message'] = "Error: Only JPG, JPEG, and PNG files are allowed.";
        }
    } else {
        $_SESSION['error_message'] = "Error uploading file.";
    }
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Event Management</a>
    <div class="ml-auto">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="activity_logs.php">Activity Logs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="venue.php">Events</a>
            </li>
            <li class="nav-item">
                <a class= "nav-link" href="../login.php"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2>Add Event</h2>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    } elseif (isset($_SESSION['error_message'])) {
        echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <form action="add_venues.php?venue_id=<?php echo isset($_GET['venue_id']) ? $_GET['venue_id'] : ''; ?>" method="post" enctype="multipart/form-data">
    <label for="venue_name">Event:</label><br>
    <input type="text" id="venue_name" name="venue_name"><br>
    <input type="hidden" name="venue_id" value="<?php echo isset($_GET['venue_id']) ? $_GET['venue_id'] : ''; ?>">
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
    <input type="file" id="venue_image" name="venue_image"><br>
    <label for="products">Select Products:</label><br>
<?php
// Fetch products from the database
$product_result = $connection->query("SELECT * FROM product");
if ($product_result && $product_result->num_rows > 0) {
    while($product_row = $product_result->fetch_assoc()) {
        echo '<input type="checkbox" name="products[]" value="' . $product_row["id"] . '"> ' . $product_row["product_name"];
        // Display product image if available
        if (!empty($product_row["image_url"])) {
            echo '<img src="' . $product_row["image_url"] . '" alt="' . $product_row["product_name"] . '" style="max-width: 100px; max-height: 100px;">';
        }
        echo '<br>';
    }
} else {
    echo "No products available";
}
?> 

    <input type="submit" value="Add Venue">
</form>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

</body>

</html>
<style>
    body {
        font-family: 'Libre Baskerville', serif;
        background-image: url('../event/background.webp');
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        margin-top: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    textarea {
        height: 100px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .error {
        color: #ff0000;
        margin-bottom: 20px;
    }

.success {
    color: #008000;
    margin-bottom: 20px;
}
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Information</title>
    <link rel="website icon" type="jpg" href="images/logo.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .event {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .event h2 {
            margin-bottom: 10px;
        }

        .event img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Events</h1>
        <?php
        include 'connector.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT event, description, banner FROM events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                echo "<h2>" . $row["event"] . "</h2>";
                echo "<p>Description: " . $row["description"] . "</p>";
                echo "</div>";
                echo "</div>";
                echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                echo "<img src='" . $row["banner"] . "' alt='Event Banner'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
  <style>
        body {
            font-family: 'Libre Baskerville', serif; /* Change font-family to Libre Baskerville */
   margin: 0;
            padding: 200px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .request {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
  <?php
        // Database connection parameters
        include('connector.php');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve data from users and user_requests tables
        $sql = "SELECT u.username, ur.id, ur.event_name, ur.event_date, ur.start_time, ur.end_time, ur.venue, ur.event_type, ur.event_style, ur.guest_count, ur.preferred_cuisine, ur.budget, ur.location, ur.ambiance, ur.alcohol_and_beverage, ur.special_requests
                FROM users u
                INNER JOIN user_requests ur ON u.id = ur.user_id";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='request'>";
                echo "<p><strong>Username:</strong> " . $row["username"] . "</p>";
                echo "<p><strong>Event Name:</strong> " . $row["event_name"] . "</p>";
                echo "<p><strong>Event Date:</strong> " . $row["event_date"] . "</p>";
                echo "Start Time: " . $row["start_time"] . "<br>";
                echo "End Time: " . $row["end_time"] . "<br>";
                echo "Venue: " . $row["venue"] . "<br>";
                echo "Event Type: " . $row["event_type"] . "<br>";
                echo "Event Style: " . $row["event_style"] . "<br>";
                echo "Guest Count: " . $row["guest_count"] . "<br>";
                echo "Preferred Cuisine: " . $row["preferred_cuisine"] . "<br>";
                echo "Budget: " . $row["budget"] . "<br>";
                echo "Location: " . $row["location"] . "<br>";
                echo "Ambiance: " . $row["ambiance"] . "<br>";
                echo "Alcohol and Beverage: " . $row["alcohol_and_beverage"] . "<br>";
                echo "Special Requests: " . $row["special_requests"] . "<br>";

        
                echo "<button class='add-button' onclick='location.href=\"add_event.php?id=" . $row["id"] . "\";'>Add Event</button>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

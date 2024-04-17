<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Request Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .navbar {
            height: 60px !important; /* Adjust the height as needed */
            background-color: black !important; /* Set the background color to transparent */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .container {
            margin-top: 100px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 20px;
        }

        .table-container {
            width: 80%;
            margin: auto;
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Event Management</a>
        <div class="ml-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Venues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
       

            </table>
        </div>
    </div>
    <div class="section">
    <h2>Toys</h2>
    <form action="process_selection.php" method="POST"> <!-- Form for submitting toy selections -->
        <div class="table-container">
            <table>
                <!-- Table headers for toys -->
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                      <th>Select</th> <!-- New column for selection -->
                </tr>
                <!-- PHP code for displaying toys -->
                <?php
                // Database connection parameters (you can remove this if already included)
                include('../connector.php');

                // Retrieve all toys from the database
                $sql_toys = "SELECT * FROM product";
                $result_toys = $connection->query($sql_toys);

                if ($result_toys->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result_toys->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td><input type='checkbox' name='toy_ids[]' value='" . $row["id"] . "'></td>"; // Checkbox for selection
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No toys found</td></tr>";
                }

                $connection->close();
                ?>
            </table>
        </div>
        <input type="hidden" name="user_request_id" value="<?php echo $user_request_id; ?>">
 <button type="submit">Submit Selection</button> <!-- Button to submit toy selections -->
    </form>
</div>

</div>
</body>
</html>
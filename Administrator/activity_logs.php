<?php
include('../connector.php');

function deleteAllLogs($conn)
{
    $sql = "DELETE FROM login_logs";
    if ($conn->query($sql) === TRUE) {
        echo "All login logs deleted successfully";
    } else {
        echo "Error deleting login logs: " . $conn->error;
    }
}

if (isset($_POST['delete_logs'])) {
    deleteAllLogs($conn);
}

$sql = "SELECT * FROM login_logs ORDER BY login_time DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Logs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #343a40;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
        }

        .navbar-brand, .navbar-item {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-item:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .container {
            margin-top: 20px;
        }

        .table {
            background-color: #fff;
        }

        .table th, .table td {
            border-top: none;
            vertical-align: middle;
        }

        .button.is-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .button.is-danger:hover {
            background-color: #bd2130;
        }
    </style>
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
                    <a class="nav-link" href="event.php">Venues Available</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Events</a>
                </li> 
                 <li class="nav-item">
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
<div class="container">
    <h2>Login Logs</h2>
    <form method="post">
        <button type="submit" name="delete_logs" class="button is-danger">Delete All Logs</button>
    </form>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Login Time</th>
            <th>User ID</th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["login_time"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
            }
        } else {
            echo "<tr><td colspan='3'>No login logs found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

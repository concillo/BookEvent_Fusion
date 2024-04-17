<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel - User Requests</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>   
    body {
        font-family: 'Libre Baskerville', serif;
        margin: 0;
        padding: 0;
        background-color:grey;
        background-size: cover;
    }

    header {
        background-color: saddlebrown;
        color: white;
        padding: 10px 20px;
        z-index: 1000; 
    }

    .sidebar {
        position: fixed;
        top: 60px; 
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #333; 
        color: white;
        padding-top: 20px; 
        overflow-y: auto;
        z-index: 100;
        display: none; 
    }

    .sidebar a {
        display: block;
        padding: 10px 20px; 
        color: white;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #555; /* Hover background color */
    }
    footer {
            background-color: #f9f9f9;
            padding: 20px 0;
            text-align: center;
            margin-top: 800px;
            border-radius: 0 0 8px 8px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }
    .navbar-brand {
        font-size: 1.5rem;
        margin-left: 20px;
    }

    .sidebar i {
        margin-right: 10px;
    }

    .sidebar a.active {
        background-color: #555 !important;
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
                    <a class="nav-link" href="activity_logs.php">Activity Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="venue.php">Venues</a>
                </li>
                <li class="nav-item">
                 <a class= "nav-link" href="../login.php"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container">
    <h2>User Requests</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>User ID</th>
                   <th>Event Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../connector.php');
                
                $sql = "SELECT * FROM user_requests";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["user_id"]."</td>";
                        echo "<td>".$row["event_date"]."</td>";
                        echo "<td><a href='respond_request.php?id=".$row["id"]."'>Respond</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>@Event Planner and Booking Management System by Concillo & Rabutin FDS A.Y. 2024 All Rights Reserved.</p>
    </div>
</footer>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.style.display = (sidebar.style.display === "none") ? "block" : "none";
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venues</title>
    <link rel="website icon" type="jpg" href="images/logo.jpg">
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
            height: 60px !important;
            /* Adjust the height as needed */
            background-color: black !important;
            /* Set the background color to transparent */
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

        .venue-card {
            width: 200px;
            padding: 20px;
            background-color: #343a40;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .venue-card:hover {
            background-color: #495057;
        }

        .venue-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .venue-name {
            font-size: 18px;
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
        <a href="Italian_Restaurant/index.php" class="venue-card">
            <i class="fas fa-pizza-slice venue-icon"></i>
            <span class="venue-name">The Loft Lounge</span>
        </a>
        <a href="American_Restaurant/index.php" class="venue-card">
            <i class="fas fa-hamburger venue-icon"></i>
            <span class="venue-name">The Garden Grove Cafe</span>
        </a>
        <a href="Vegan_Restaurant/index.php" class="venue-card">
            <i class="fas fa-leaf venue-icon"></i>
            <span class="venue-name">Coastal Breeze Seafood Grill</span>
        </a>
        <a href="Japanese_Restaurant/index.php" class="venue-card">
            <i class="fas fa-sushi venue-icon"></i>
            <span class="venue-name">Harmony Hall</span>
        </a>
        <a href="Mediterranean_Restaurant/index.php" class="venue-card">
            <i class="fas fa-utensils venue-icon"></i>
            <span class="venue-name">The Grand Ballroom</span>
        </a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</body>

</html>
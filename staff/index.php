<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <?php
                            if(isset($_SESSION["role"])) {
                                if($_SESSION["role"] === "client") {
                                    echo 'Welcome to Your Client Dashboard, ';
                                } elseif($_SESSION["role"] === "vendor") {
                                    echo 'Welcome to Your Vendor Dashboard, ';
                                } elseif($_SESSION["role"] === "staff") {
                                    echo 'Welcome to Your Staff Dashboard, ';
                                } elseif($_SESSION["role"] === "admin") {
                                    echo 'Welcome to Your Admin Dashboard, ';
                                }
                            }
                            echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
                        ?>!
                    </div>
                    <div class="card-body">
                        <!-- Content of the dashboard -->
                    </div>
                    <div class="card-footer text-muted">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

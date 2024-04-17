
<?php
session_start();

require_once "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $store = $_POST["store"];
    $role = $_POST["role"];
    $pic = $_FILES["pic"]["name"];

    // Validate password confirmation
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement for inserting user data into the database
    $sql = "INSERT INTO users (username, email, password, store, type, pic) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error: " . mysqli_error($conn));
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $hashed_password, $store, $role, $pic);
    mysqli_stmt_execute($stmt);

    // Check if the insertion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Close statement and database connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Redirect to the login page
        header("Location: login.php");
        exit;
    } else {
        echo "Error: Failed to register user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="website icon" type="jpg" href="images/logo.jpg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>  body {           font-family: 'Libre Baskerville', serif;
            margin: 20;
            padding: 60;
            background-image: url('images/home.jpg');
            background-size: cover;
        }

        footer {
            background-color: black;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: 300px;
        }

        header {
            background-color: #333;
            color: white;
            text-align: left;
            padding: 10px 20px;
            display: flex;
        }

        .card {
            margin-top: 0px;
        }

        .card-header {
            background-color: grey;
            color: black;
        }

        .navbar-custom {
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }

        .navbar-custom b {
            margin-right: 20px;
            font-size: 1.5rem;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: yellow;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <b style="margin-right: 800px;">Event Planning Book MS</b>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">SignUp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        User Registration
                    </div>
                    <div class="card-body">
                        <form action="registration.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="store">Store:</label>
                                <select name="store" id="store" class="form-control" required>
                                    <option value="Italian">Italian Restaurant</option>
                                    <option value="Japanese">Japanese Restaurant</option>
                                    <option value="American">American Restaurant</option>
                                    <option value="Mediterranean">Mediterranean Restaurant</option>
                                    <option value="Vegetarian">Vegetarian and Vegan Restaurant</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pic">Profile Picture:</label>
                                <input type="file" name="pic" id="pic" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <h3>For inquiries or assistance, please contact us at:</h3>
        <p><i class="fas fa-envelope"></i> Concillo@example.com</p>
        <p><i class="fas fa-phone"></i> +69465575762</p>
        <p>&copy; 2025 Restaurant Name. All rights reserved.</p>
    </footer>
    <div class="modal fade" id="registrationSuccessModal" tabindex="-1" role="dialog"
        aria-labelledby="registrationSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationSuccessModalLabel">Registration Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your registration was successful.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        <?php if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) { ?>
            $(document).ready(function () {
                $('#registrationSuccessModal').modal('show');
            });
            <?php
            unset($_SESSION['registration_success']);
        } ?>
    </script>
</body>

</html>
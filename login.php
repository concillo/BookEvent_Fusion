<?php
session_start();

include ('connector.php');

function insertLoginLog($conn, $userId, $username)
{
    $sql = "INSERT INTO login_logs (user_id, username, login_time) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $username);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = $conn->real_escape_string($email);
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["type"] = $row["type"];

            insertLoginLog($conn, $row["id"], $row["username"]);
            if ($_SESSION["type"] == "admin") {
                header("Location: administrator/index.php");
            } elseif ($_SESSION["type"] == "client") {
                header("Location: client/index.php");
            }
            exit();
        } else {
            $_SESSION["login_error"] = "Invalid email or password";
        }
    } else {
        $_SESSION["login_error"] = "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="website icon" type="jpg" href="images/logo.jpg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            ;
            margin: 20;
            padding: 60;
            background-image: url('images/index.png');
            background-size: cover;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        div {
            font-family: 'Arial', sans-serif;
        }

        header {
            background-color: #333;
            color: white;
            text-align: left;
            padding: 10px 20px;
            display: flex;
        }

        footer {
            background-color: black;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: 300px;
        }

        .card {
            margin-top: 50px;
            background-color: #F3F0E6;
        }

        .card-header {
            background-color: #465048;
            color: WHITE;
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

        #incorrectPasswordModal .modal-dialog {
            margin-top: 20%;
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
                    <div class="card-header">User Login</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
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
    <div id="incorrectPasswordModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Incorrect Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The password you entered is incorrect. Please try again.</p>
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
        // JavaScript to trigger the modal for incorrect password
        <?php
        if (isset($_SESSION["login_error"]) && $_SESSION["login_error"] === "Invalid email or password") {
            echo '$(document).ready(function() { $("#incorrectPasswordModal").modal("show"); });';
            unset($_SESSION["login_error"]);
        }
        ?>
    </script>
</body>

</html>
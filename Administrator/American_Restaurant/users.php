<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            padding: 20px;
            width: 1300px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .table th, .table td {
            border-top: none;
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-action {
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center"> <!-- Center the card horizontally -->
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                   <table id="user_table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Type</th>
            <th class="text-center">Store</th>
            <th class="text-center">Profile Picture</th> <!-- New column for profile picture -->
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../../connector.php';

        $users = $conn->query("SELECT id, username, email, type, store, pic FROM users WHERE store = 'american' ORDER BY username ASC");

        $i = 1;
        while ($row = $users->fetch_assoc()) :
            ?>
            <tr>
                <td class="text-center"><?php echo $i++ ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo ucfirst($row['type']) ?></td>
                <td><?php echo ucfirst($row['store']) ?></td>
                <td class="text-center"><img src="dp/<?php echo $row['pic']; ?>" alt="Profile Picture" style="max-width: 100px;"></td> <!-- Adjusted image source -->
                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-action">Action</button>
                        <button type="button" class="btn btn-action dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>

    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle click event for adding new user
        $('#new_user').click(function() {
            // Implement your logic here
        });

        // Handle click event for editing user
        $('.edit_user').click(function() {
            // Implement your logic here
        });

        // Handle click event for deleting user
        $('.delete_user').click(function() {
            // Implement your logic here
        });
    });
</script>
</body>
</html>

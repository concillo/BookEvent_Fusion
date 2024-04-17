<?php
include ('../connector.php');

$sql = "SELECT *, bookingStatus FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            color: #333;
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        /* Responsive table styles */
        @media screen and (max-width: 600px) {
            table {
                border: none;
            }

            thead {
                display: none;
            }

            tr {
                border-bottom: 2px solid #ddd;
                display: block;
                margin-bottom: 10px;
            }

            td {
                display: block;
                text-align: right;
                font-size: 14px;
            }

            td:before {
                content: attr(data-label);
                font-weight: bold;
                display: inline-block;
                width: 50%;
                margin-left: -50%;
                padding-right: 10px;
            }
        }

        .take-action-btn {
            background-color: #8BC34A;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .take-action-btn:hover {
            background-color: #689F38;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select,
        textarea {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        /* Submit Button */
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        /* Status Colors */
        .status-accepted {
            background-color: #C8E6C9;
            /* Soft green */
        }

        .status-rejected {
            background-color: #FFCDD2;
            /* Red */
        }

        .status-pending {
            background-color: #FFF9C4;
            /* Yellow */
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
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update Booking Status</h2>
            <form id="updateForm" action="booking_status.php" method="post">
                <input type="hidden" name="id" value="">
                <select name="status" id="status" required>
                    <option value="">Select Booking Status</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <textarea name="official_remark" id="official_remark" placeholder="Official Remark" rows="5"
                    required></textarea>
                <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>Venue Name</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Guest Count</th>
                <th>Message</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Determine the class based on booking status
                    $statusClass = '';
                    switch ($row['bookingStatus']) {
                        case 'Accepted':
                            $statusClass = 'status-accepted';
                            break;
                        case 'Rejected':
                            $statusClass = 'status-rejected';
                            break;
                        case 'Pending':
                            $statusClass = 'status-pending';
                            break;
                        default:
                            $statusClass = '';
                            break;
                    }

                    // Output table row with appropriate status class
                    echo "<tr class='$statusClass'>";
                    echo "<td>" . $row['venue_name'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['end_time'] . "</td>";
                    echo "<td>" . $row['guest_count'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";
                    echo "<td><button class='take-action-btn' data-id='" . $row['id'] . "'>Take Action</button></td>";
                    echo "<td class='status'>" . $row['bookingStatus'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            // Hide action button for rows with status Accepted or Rejected
            $(".status").each(function () {
                var status = $(this).text();
                if (status === "Accepted" || status === "Rejected") {
                    $(this).closest("tr").find(".take-action-btn").hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var modal = $("#myModal");
            var btns = $(".take-action-btn");
            var span = $(".close");

            btns.on('click', function () {
                var bookingId = $(this).data('id');
                modal.find("input[name='id']").val(bookingId);
                modal.show();
            });

            span.on('click', function () {
                modal.hide();
            });

            $(window).on('click', function (event) {
                if (event.target == modal[0]) {
                    modal.hide();
                }
            });
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</body>

</html>
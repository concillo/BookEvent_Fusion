<?php
// Include database connection
include('../connector.php');

// Fetch booking data from the database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        /* Modal (background) */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        th, td {
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
        .take-action-btn {
        background-color: #8BC34A; /* Light green */
        color: white; /* White text */
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .take-action-btn:hover {
        background-color: #689F38; /* Darker green on hover */
    }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Booking Details</h1>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
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
            <input type="text" name="venue_no" id="venue_no" placeholder="Venue No" required>
            <textarea name="official_remark" id="official_remark" placeholder="Official Remark" rows="5" required></textarea>
            <button type="submit" class="btn-submit">Update</button>
        </form>
    </div>
</div>

<table border="1">
    <thead>
        <tr><th>Date</th>
            <th>Venue No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Guest Count</th>
            <th>Action</th>
            <th>Booking Status</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through each booking and display it in a table row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['venue_no'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['guest_count'] . "</td>";
                echo "<td><button class='take-action-btn' data-id='".$row['id']."'>Take Action</button></td>";
                echo "<td>" . $row['bookingStatus'] . "</td>"; // Display Booking Status from the database
                echo "<td>" . $row['adminremark'] . "</td>"; // Display Admin Remark from the database
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No bookings found</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- JavaScript -->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btns = document.querySelectorAll(".take-action-btn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            modal.style.display = "block";
            var bookingId = this.getAttribute('data-id');
            document.querySelector("input[name='id']").value = bookingId;
        });
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>

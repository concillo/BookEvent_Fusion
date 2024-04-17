<?php
include "config.php";
$start = 0;
$rows_per_page = 6;

$records = $conn->query("SELECT * FROM toys ");
$nr_of_rows = $records->num_rows;
$pages = ceil($nr_of_rows / $rows_per_page);
$result = null;

if (isset($_GET["page-nr"])) {
    $page = $_GET["page-nr"] - 1;
    $start = $page * $rows_per_page;
}

$sort = '';
if (isset($_GET['sort']) && ($_GET['sort'] == 'name' || $_GET['sort'] == 'date_created' || $_GET['sort'] == 'company_id' || $_GET['sort'] == 'rate')) {
    $sort = $_GET['sort'];
}

if ($sort != '') {
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = $conn->query("SELECT toys.*, company.name AS company_name
                                FROM toys
                                LEFT JOIN company ON toys.company_id = company.id
                                WHERE toys.name LIKE '%$search%'
                                   OR toys.description LIKE '%$search%'
                                   OR toys.company_id LIKE '%$search%'
                                   OR toys.price LIKE '%$search%'
                                   OR toys.rate LIKE '%$search%'
                                   OR toys.date_created LIKE '%$search%'
                                ORDER BY $sort
                                LIMIT $start, $rows_per_page WHERE toys.status = 'available'");
    } else {
        $result = $conn->query("SELECT toys.*, company.name AS company_name
                                FROM toys
                                LEFT JOIN company ON toys.company_id = company.id 
                                ORDER BY $sort
                                LIMIT $start, $rows_per_page WHERE toys.status = 'available'");
    }
} else {
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = $conn->query("SELECT toys.*, company.name AS company_name
                                FROM toys
                                LEFT JOIN company ON toys.company_id = company.id
                                WHERE toys.name LIKE '%$search% '
                                   OR toys.description LIKE '%$search%'
                                   OR toys.company_id LIKE '%$search%'
                                   OR toys.price LIKE '%$search%'
                                   OR toys.rate LIKE '%$search%'
                                   OR toys.date_created LIKE '%$search%'
                                LIMIT $start, $rows_per_page");
    } else {
        $result = $conn->query("SELECT toys.*, company.name AS company_name
        FROM toys
        LEFT JOIN company ON toys.company_id = company.id
        WHERE toys.status = 'available'
        LIMIT $start, $rows_per_page");

    }
}


// Check if the 'id' parameter is set
if (isset($_GET['cartid'])) {

    $itemid = $_GET['cartid'];

    $query = "SELECT * FROM toys WHERE id = '$itemid'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the data
        $row = mysqli_fetch_assoc($result);
        $rating = $row['rate']; // Assuming 'rating' is the column in your database

        // Output HTML for the modal
        echo '
            <div class="modal-body">
                <!-- Content to be updated dynamically based on the query result -->
                <div class="container">
                    <div class="row">
                        <!-- Left side: Image -->
                        <div class="col-md-6">
                            <img src="img/toys/' . $row['img'] . '" id="modalImage" class="img-fluid" alt="' . $row['img'] . '">
                        </div>

                        <!-- Right side: Details -->
                        <div class="col-md-6">
                            <div class="form-group">
                              
                                <p id="modalName" class="form-control-static"> Toy Name: ' . $row['name'] . '</p>
                            </div>

                            <div class="form-group">
                               
                                <p id="modalPrice" class="form-control-static">Toy Price: ' . $row['price'] . '</p>
                            </div>
                            <div class="form-group">
                               
                                <p id="modalPrice" class="form-control-static">Stocks: ' . $row['quantity'] . '</p>
                            </div>

                      
                            <div class="form-group">
                            <label for="quantityInput">Quantity:</label>
                            <input type="number" class="form-control" id="addtocartquantity" name="addtocartquantity" min="1" max="' . $row['quantity'] . '" value="1">
                            <input type="hidden" id="addtocartid" name="addtocartid" value="' . $row['id'] . '">
                            <input type="hidden" id="addtocartcompany" name="addtocartcompany" value="' . $row['company_id'] . '">
                        </div>
                        

                            <div class="form-group">
                                <label for="modalRating">Rating:</label>
                                <div id="modalRating" class="form-control-static">
                                ';

        // Display rating stars dynamically
        for ($i = 1; $i <= 5; $i++) {
            echo ($i <= $rating) ? '<i class="fas fa-star text-warning"></i>' : '<i class="far fa-star text-warning"></i>';
        }

        echo '
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                            <a id="addToCartLink" class="btn btn-primary"  onclick="addtocartconfirm()">Add to cart</a>
                            </div>
                        </div>
            
                        ';






        mysqli_close($conn);
    } else {
        // Handle the case where the query was not successful
        echo 'Error in database query: ' . mysqli_error($conn);
    }
}


if (isset($_GET["addtocartid"]) && isset($_GET["addtocartquantity"])) {
    $orderid = $_GET["addtocartid"];
    $orderquantity = $_GET["addtocartquantity"];

    $toyquantity = "SELECT quantity FROM toys WHERE id = $orderid";
    $toyquantityqry = $conn->query($toyquantity);
    $toyquantityrow = mysqli_fetch_assoc($toyquantityqry);

    if ($toyquantityrow["quantity"] > $orderquantity) {
        // Start a transaction to ensure data consistency
        // $conn->begin_transaction();

        try {
            // Step 1: Update toy quantity
            $update_toy_query = "UPDATE toys SET quantity = quantity - $orderquantity WHERE id = $orderid";
            $go = $conn->query($update_toy_query);


            // Step 2: Insert or update order details
            $checkcart = "SELECT * FROM user_cart WHERE  toy_id = $orderid";
            $checkcartresult = $conn->query($checkcart);

            if (mysqli_num_rows($checkcartresult) == 0) {
                $insert_order_query = "INSERT INTO user_cart (user_id, toy_id, quantity, status) VALUES ($user_id, $orderid, $orderquantity, 'active')";
            } else {
                $insert_order_query = "UPDATE user_cart SET quantity = quantity + $orderquantity WHERE toy_id = $orderid";
            }

            $d2 = $conn->query($insert_order_query);

            if ($d2) {
                var_dump($d2);
            }


            // Step 3: Update user's purchase history

            // Commit the transaction
            $conn->commit();

            // Display success notification
            echo '
            <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto" role="alert" style="max-width: 300px;">
                <strong>Order Successful!</strong> Your order has been placed successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $conn->rollback();

            // Handle the error (log it, display an error message, etc.)
            echo 'Error: ' . $e->getMessage();
        }
    } elseif ($toyquantityrow["quantity"] <= $orderquantity) {
        // Start a transaction to ensure data consistency
        $conn->begin_transaction();

        try {
            // Step 1: Delete the toy
            $delete_toy_query = "UPDATE toys SET status = 'out of stock' WHERE id = $orderid";
            $conn->query($delete_toy_query);

            // Step 2: Insert order details
            $insert_order_query = "INSERT INTO user_cart (user_id, toy_id, quantity, status ) VALUES ($user_id, $orderid, $orderquantity, 'active')";
            $conn->query($insert_order_query);

            // Step 3: Update user's purchase history

            // Commit the transaction
            $conn->commit();

            // Display success notification
            echo '
            <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto" role="alert" style="max-width: 300px;">
                <strong>Order Successful!</strong> Your order has been placed successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $conn->rollback();

            // Handle the error (log it, display an error message, etc.)
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        // Item is out of stock, handle accordingly
        echo 'Item is out of stock';
    }
}



if (isset($_GET["cancelallsuccess"])) {
    $cancelallqry = "DELETE FROM user_cart  WHERE user_id = $user_id";
    $cancelallresult = $conn->query($cancelallqry);
    if ($cancelallresult) {
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto" role="alert" style="max-width: 300px;">
            <strong>All items canceled!</strong> Your order has been canceled successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
}

if (isset($_GET["order_placed"])) {
    echo '
    <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto" role="alert" style="max-width: 300px;">
        <strong> item placed!</strong> Your order has been placed successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}

if (isset($_GET["userlogout"])) {
    $user_id = $_GET["userlogout"];

    // Assuming $conn is your database connection object

    // Fetch user name
    $nameQuery = "SELECT CONCAT(fname, ' ', mname, ' ', lname) as name FROM accounts WHERE id = $user_id";
    $nameResult = $conn->query($nameQuery);
    $nameRow = mysqli_fetch_assoc($nameResult);
    $userName = $nameRow['name'];

    // Insert logout activity into user_logs
    $logoutqry = "INSERT INTO user_logs (user_id, activities) VALUES ($user_id, '$userName logged out')";
    $conn->query($logoutqry);

    header("Location: index.php");
    exit();
}


if (isset($_POST["cancel_cart_id"]) && isset($_POST["cancel_cart_quantity"])) {
    // Assuming you have access to the database connection ($conn)
    $cancel_cart_id = $_POST["cancel_cart_id"];
    $cancel_cart_quantity = $_POST["cancel_cart_quantity"];

    // Add your logic here to fetch additional information based on $cancel_cart_id
    // For example, you can retrieve the product details from the database
    $product_query = "SELECT toys.*, user_cart.quantity FROM user_cart LEFT JOIN toys ON toys.id = user_cart.toy_id WHERE user_cart.id = $cancel_cart_id";

    $product_result = $conn->query($product_query);

    if ($product_result->num_rows > 0) {
        $product_row = $product_result->fetch_assoc();
        ?>

        <div class="modal-body">
            <p>Are you sure you want to cancel the following item?</p>
            <img src="img/toys/<?php echo $product_row["img"] ?>" alt="<?php echo $product_row["img"] ?>"
                style="max-width: 100px;">
            <p><strong>Name:</strong>
                <?php echo $product_row["name"] ?>
            </p>
            <p><strong>Price:</strong> $
                <?php echo $product_row["price"] ?>
            </p>
            <p><strong>Quantity:</strong>
                <?php echo $cancel_cart_quantity ?>
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="?confirm_cancel_item_id=<?php echo $cancel_cart_id ?>&confirm_cancel_item_quantity=<?php echo $cancel_cart_quantity ?>"
                class="btn btn-danger">Confirm Cancel</a>
        </div>

        <?php
    } else {
        // Handle the case where the product is not found
        echo '<p>Error: Product not found.</p>';
    }
}
if (isset($_GET["confirm_cancel_item_id"])) {
    $toy_id = $_GET["confirm_cancel_item_id"];
    $cancel_cart_quantity = $_GET["confirm_cancel_item_quantity"];
    $qry = "SELECT SUM(quantity) as total_quantity FROM user_cart WHERE id = $toy_id";
    $result = $conn->query($qry);

    // Check if the query was successful
    if ($result) {
        $row = $result->fetch_assoc();

        if ($row["total_quantity"] == $cancel_cart_quantity) {
            $cancelqry = "DELETE FROM user_cart WHERE id = $toy_id"; // Added missing "FROM"
            $cancelresult = $conn->query($cancelqry);

            if ($cancelresult) {
                echo '
                <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto" role="alert" style="max-width: 300px;">
                    <strong>Oops, cancelled!</strong> Your order has been canceled successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } elseif ($row["total_quantity"] > $cancel_cart_quantity) {
            $cancelqry = "UPDATE user_cart SET quantity = quantity - $cancel_cart_quantity WHERE id = $toy_id"; // Changed single quotes to double quotes
            $cancelresult = $conn->query($cancelqry);

            if ($cancelresult) {
                echo '
                <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto" role="alert" style="max-width: 300px;">
                    <strong>Oops, cancelled!</strong> Your order has been partially canceled successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            echo "Error: Quantity to cancel exceeds total quantity.";
        }
    } else {
        // Handle query error
        echo "Error: " . $qry . "<br>" . $conn->error;
    }
}

?>
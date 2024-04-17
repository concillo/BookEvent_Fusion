<?php {
    $conn = mysqli_connect("sql6.freesqldatabase.com", "sql6691333", "JcDgZUMWNU", "sql6691333");

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    return $conn;
}

$conn = connectToDatabase();
?>
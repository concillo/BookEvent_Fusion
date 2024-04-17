<?php
    
    $conn = mysqli_connect("sql6.freesqldatabase.com", "sql6691333", "JcDgZUMWNU", "sql6691333");
    $conn3= mysqli_connect("sql.freedb.tech", "freedb_kuya123mikmik", "ay4JFA3Rq&pM8Xj", "freedb_restaurant");
    $connection = mysqli_connect("sql.freedb.tech", "freedb_verna", "Q#M#snMx3?un9nA", "freedb_delivery");
    
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // return $conn;

// $conn = connectToDatabase();
?>
<?php

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $category = $_POST['category'];
    $product_condition = $_POST['product_condition'];
    $location = $_POST['location'];

    // Upload Image line
    $target_dir = "uploadImage";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'ecohaven';

    //connect to database Eco Haven
    $conn = mysqli_connect($host, $user, $pass, $dbname);

     // Check connection - error handling
     if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    //inserting data
    $sql = "INSERT INTO products(full_name, email, product_name, category, product_condition, location, image)
    VALUES('$name', '$email', '$product','$category', '$product_condition', '$location', '$target_file')";

    //check success/fail
    if (mysqli_query($conn, $sql)) {
        echo "Your Item listed successfully!";
    } else {
        echo "Error:" . mysqli_error($conn);

    }

    //end database connection
    mysqli_close($conn);
}
?>
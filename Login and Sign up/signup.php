<?php

if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];


    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'ecohaven';

    $conn = mysqli_connect($host, $user, $pass, $dbname);

     // Check connection - error handling
     if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    //inserting data
    $sql = "INSERT INTO user(username, email, password)
    VALUES('$username', '$email', '$password')";

    //check success/fail
    if (mysqli_query($conn, $sql)) {
        echo "Your have registered successfully!";
    } else {
        echo "Error:" . mysqli_error($conn);

    }

    //end database connection
    mysqli_close($conn);

}
?>
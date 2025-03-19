<?php
// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form fields
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $age = $_POST['age']; 
    $address = $_POST['address'];

    // Connect to the MySQL database
    $conn = mysqli_connect("localhost", "root", "", "ecohaven");

    // Check if the connection is successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());  // If connection fails, stop the script
    }

    // Insert the data into the database (including the image name)
    $sql = "INSERT INTO join_event (name, email, phone, age, address) 
            VALUES ('$fname', '$email', '$phone', '$age', '$address')";

    // Execute the query and check if the data is inserted successfully
    if (mysqli_query($conn, $sql)) {
        echo "Join event successfully!";  // Success message
    } else {
        echo "Error: " . mysqli_error($conn);  // Error message if the query fails
    }

    // Close the database connection
    mysqli_close($conn);

    //Redirect to cs.html after processing
    header("Location: collection_schedules.php");
    exit();
}
?>

<?php
// Connect to the MySQL database
include "conn.php";

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form fields
    $event_id = $_POST['event_id'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $age = $_POST['age']; 
    $address = $_POST['address'];

    if (!empty($event_id)) {
        $sql = "INSERT INTO join_event (event_id, name, email, phone, age, address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Fixed variable name: `$fname` instead of `$name`
            mysqli_stmt_bind_param($stmt, "isssis", $event_id, $fname, $email, $phone, $age, $address);
            if (mysqli_stmt_execute($stmt)) {
                // Redirect before any output
                header("Location: collection_schedules.php");
                exit();
            } else {
                echo "<script>alert('Error joining event.');</script>";
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "<script>alert('Invalid event ID.');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

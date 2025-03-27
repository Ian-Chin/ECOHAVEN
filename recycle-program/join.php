<?php
// Connect to the MySQL database
include "conn.php";

session_start(); // Start session to get user ID

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    echo "<script>alert('You must be logged in to join an event.'); window.location.href='login.php';</script>";
    exit(); // Stop script execution
}

// Get userID from session
$userID = $_SESSION['userID'];

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
        $sql = "INSERT INTO join_event (event_id, userID, name, email, phone, age, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters (event_id, userID, name, email, phone, age, address)
            mysqli_stmt_bind_param($stmt, "iisssis", $event_id, $userID, $fname, $email, $phone, $age, $address);

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

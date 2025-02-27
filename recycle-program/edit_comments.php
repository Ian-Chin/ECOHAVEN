<?php

// Database connection
include 'conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and check required fields
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; // Assuming cid is the primary key
    $date = isset($_POST["date"]) ? $_POST['date'] : "";
    $message = isset($_POST["message"]) ? $_POST['message'] : "";

    if ($id == 0 || $date == "" || $message == "") {
        echo "Error: All fields are required.";
        exit();
    }
    
    // Prepare the UPDATE query using cid as the identifier
    $sql = "UPDATE comments SET date = ?, message = ? WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Corrected bind_param() format
        $stmt->bind_param("ssi", $date, $message, $id);
        $stmt->execute();

        // After updating, redirect to the main admin page.
        header("Location: recycle_admin_main.php");
        exit();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close database connection
mysqli_close($conn);
?>

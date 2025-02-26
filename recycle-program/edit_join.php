<?php
// edit_join_event.php

// Database connection
include 'conn.php';

// Process the form if a POST request is detected
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize data from the form
    $id      = intval($_POST['id']); // join_id (hidden field)
    $name    = trim($_POST['fname']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    // If age is stored as an integer in the database, convert it accordingly:
    $age     = intval($_POST['age']);
    $address = trim($_POST['address']);

    // Prepare the UPDATE query using join_id as the identifier
    $stmt = $conn->prepare("UPDATE join_event SET name = ?, email = ?, phone = ?, age = ?, address = ? WHERE join_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Bind the parameters.
    // If age is an integer, then use "sssisi":
    $stmt->bind_param("sssisi", $name, $email, $phone, $age, $address, $id);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        header("Location: recycle_admin_main.php");
        exit();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

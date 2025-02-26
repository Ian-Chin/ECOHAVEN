<?php

// Database connection
include 'conn.php';

// Check if id is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer

    // Prepare the DELETE statement using the event_id column
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // You may check affected_rows if needed
    if ($stmt->affected_rows > 0) {
        header("Location: recycle_admin_main.php");
        exit();
    } else {
        echo "Error: No record was deleted.";
    }
    $stmt->close();
} else {
    echo "No event id specified.";
}

$conn->close();
?>

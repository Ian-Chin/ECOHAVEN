<?php

// Database connection
include 'conn.php';

// Check if type and id are provided in the URL
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); // Ensure id is an integer

    // Define allowed types and their corresponding table and column
    $deleteMap = [
        'comment' => ['table' => 'comments', 'column' => 'cid'],
        'event' => ['table' => 'recycle_event', 'column' => 'event_id'],
        'join' => ['table' => 'join_event', 'column' => 'join_id'],
        'product' => ['table' => 'products', 'column' => 'id'],
        'user' => ['table' => 'user', 'column' => 'user_id']
    ];

    if (!array_key_exists($type, $deleteMap)) {
        die("Invalid type specified.");
    }

    $table = $deleteMap[$type]['table'];
    $column = $deleteMap[$type]['column'];

    // Prepare the DELETE statement dynamically
    $stmt = $conn->prepare("DELETE FROM $table WHERE $column = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: recycle_admin_main.php");
        exit();
    } else {
        echo "Error: No record was deleted.";
    }

    $stmt->close();

} else {
    echo "No type or id specified.";
}

$conn->close();
?>

<?php
// edit_join_event.php

// Database connection
include 'conn.php';

// Process the form if a POST request is detected
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize data from the form
    $id       = intval($_POST['id']); // user_id (hidden field)
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']); // Assuming this field is actually the password

    // Validate required fields
    if ($id == 0 || empty($username) || empty($email) || empty($password)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Hash the password before saving it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the UPDATE query using user_id as the identifier
    $stmt = $conn->prepare("UPDATE user SET username = ?, email = ?, password = ? WHERE user_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssi", $username, $email, $hashed_password, $id);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        header("Location: recycle_admin_main.php"); // Redirect to the correct page
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

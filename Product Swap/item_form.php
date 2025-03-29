<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbh.inc.php'; // Use external database connection file

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    error_log("User ID is NOT SET in SESSION.");
    echo json_encode(["success" => false, "error" => "You need to log in to list an item."]);
    exit;
}

$userID = $_SESSION['userID'];
error_log("Session User ID: " . $userID);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $product = $_POST['product'];
    $category = $_POST['category'];
    $condition = $_POST['product_condition']; // Match form field
    $location = $_POST['location'];

    //Image Upload Handling
    $target_dir = "uploadImage/"; // Ensure this folder exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        error_log("File uploaded successfully: " . $target_file);
    } else {
        error_log("File upload failed.");
        echo json_encode(["success" => false, "error" => "File upload failed"]);
        exit;
    }

    //Insert Data into Database (Removed `email` field)
    $sql = "INSERT INTO products (userID, full_name, product_name, category, product_condition, location, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $userID, $name, $product, $category, $condition, $location, $target_file);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Your item has been listed successfully!"]);
    } else {
        error_log("Database insert failed: " . $stmt->error);
        echo json_encode(["success" => false, "error" => "Database insert failed"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>

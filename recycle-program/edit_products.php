<?php

// Database connection
include 'conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and check required fields
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; // this value corresponds to event_id
    $full_name = isset($_POST["full_name"]) ? $_POST['full_name'] : "";
    $product_name = isset($_POST["product_name"]) ? $_POST['product_name'] : "";
    $category = isset($_POST["category"]) ? $_POST['category'] : "";
    $product_condition = isset($_POST["product_condition"]) ? $_POST['product_condition'] : "";
    $location = isset($_POST["location"]) ? $_POST['location'] : "";

    if ($id == 0 || $full_name == "" || $product_name == "" || $category == "" || $product_condition == "" || $location == "") {
        echo "Error: All fields are required.";
        exit();
    }
    
    // Set up file upload folder
    $target_dir = "uploadImage/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $event_image = "";
    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $event_image = basename($_FILES["image"]["name"]);
        } else {
            echo "Error uploading image.";
            exit();
        }
    }
    
    // If no new image, keep the old one from the database
    if ($event_image == "") {
        $query = "SELECT image FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rowData = $result->fetch_assoc();
            $event_image = $rowData['image'];
        }
        $stmt->close();
    }
    
    // Prepare the UPDATE query using id
    $sql = "UPDATE products SET full_name = ?, product_name = ?, category = ?, product_condition = ?, location = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssi", $full_name, $product_name, $category, $product_condition, $location, $event_image, $id);
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

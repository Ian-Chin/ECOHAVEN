<?php
// edit_recycle_event.php

// Database connection
include 'conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and check required fields
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; // this value corresponds to event_id
    $date = isset($_POST["date"]) ? $_POST['date'] : "";
    $name = isset($_POST["name"]) ? $_POST['name'] : "";
    $title = isset($_POST["title"]) ? $_POST['title'] : "";
    $description = isset($_POST["description"]) ? $_POST['description'] : "";

    if ($id == 0 || $date == "" || $name == "" || $title == "" || $description == "") {
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
        $query = "SELECT image FROM recycle_event WHERE event_id = ?";
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
    
    // Prepare the UPDATE query using event_id
    $sql = "UPDATE recycle_event SET date = ?, name = ?, title = ?, description = ?, image = ? WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssi", $date, $name, $title, $description, $event_image, $id);
        $stmt->execute();
        // After updating, redirect to the main admin page.
        header("Location: recycle_admin_main.php");
        exit();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

mysqli_close($conn);
?>

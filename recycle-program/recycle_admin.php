<?php
include 'conn.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $date = $_POST["date"] ?? "";
    $name = $_POST["name"] ?? "";
    $title = $_POST["title"] ?? "";
    $description = $_POST["description"] ?? "";

    // Check if all fields are filled
    if ($date && $name && $title && $description) {
        $target_dir = "uploadImage/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        // Handle image upload
        $event_image = $_FILES['image']['name'] ?? "";
        if ($event_image) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $event_image)) {
                echo "Image upload failed!";
            }
        }

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO recycle_event (date, name, title, description, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $date, $name, $title, $description, $event_image);
        
        if ($stmt->execute()) {
            header("Location: adminpage.php");
            exit();
        } else {
            echo "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
    mysqli_close($conn);
}
?>

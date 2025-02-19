<?php
// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate that all form fields exist before accessing them
    $date = isset($_POST["date"]) ? $_POST['date'] : null;
    $name = isset($_POST["name"]) ? $_POST['name'] : null;
    $title = isset($_POST["title"]) ? $_POST['title'] : null;
    $description = isset($_POST["description"]) ? $_POST['description'] : null;

    // Database connection (Move outside the condition to avoid undefined $conn)
    $conn = mysqli_connect("localhost", "root", "", "ecohaven");

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); // Proper error message
    }

    // Ensure required fields are not empty before proceeding
    if ($date && $name && $title && $description) {
        // Set the folder for image upload
        $target_dir = "uploadImage/";

        // Create the folder if it does not exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Default value if no image is uploaded
        $event_image = "";

        // Check if an image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $target_file = $target_dir . basename($_FILES["image"]["name"]);  // Full path of the uploaded file

            // Move the uploaded image to the folder
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $event_image = basename($_FILES["image"]["name"]);  // Get the name of the uploaded image
            } else {
                echo "Error uploading image.<br>";  // Error message if image upload fails
            }
        }

        // Prepare a command to insert the data into the database (including the image name)
        $stmt = $conn->prepare("INSERT INTO recycle_event (date, name, title, description, image) VALUES (?, ?, ?, ?, ?)");

        if ($stmt) {
            // Link actual values to the placeholders (?)
            $stmt->bind_param("sssss", $date, $name, $title, $description, $event_image);

            // Try to save the data in the database
            if ($stmt->execute()) {
                // If successful, go to another page
                header("Location: recycle_admin.html");
                exit();
            } else {
                // Show an error message if something went wrong
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "Error: All fields are required.";
    }
}
?>

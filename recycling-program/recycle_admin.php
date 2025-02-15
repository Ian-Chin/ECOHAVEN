<?php
// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form fields
    $event_date = $_POST['create_date'];  // Event date
    $event_title = $_POST['create_title'];  // Event title
    $event_name = $_POST['create_name'];  // Event name
    $event_description = $_POST['create_description'];  // Event description
    $event_AOP = $_POST['create_AOP'];  // Number of participants

    // Handle image upload
    $target_dir = "uploadImage/";  // Folder to upload the image
    $target_file = $target_dir . basename($_FILES["create_image"]["name"]);  // Full path of the uploaded file

    // Check if the image is uploaded successfully
    if (move_uploaded_file($_FILES["create_image"]["tmp_name"], $target_file)) {
        $event_image = basename($_FILES["create_image"]["name"]);  // Get the name of the uploaded image
    } else {
        echo "Error uploading image.<br>";  // Error message if image upload fails
    }

    // Connect to the MySQL database
    $conn = mysqli_connect("localhost", "root", "", "ecohaven");

    // Check if the connection is successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());  // If connection fails, stop the script
    }

    // Insert the data into the database (including the image name)
    $sql = "INSERT INTO recycle_events (date, name, title, description, no_of_participants, image) 
            VALUES ('$event_date', '$event_name', '$event_title', '$event_description', '$event_AOP', '$event_image')";

    // Execute the query and check if the data is inserted successfully
    if (mysqli_query($conn, $sql)) {
        echo "Event created successfully!";  // Success message
    } else {
        echo "Error: " . mysqli_error($conn);  // Error message if the query fails
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

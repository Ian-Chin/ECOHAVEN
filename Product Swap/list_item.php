<?php
session_start();
header("Content-Type: application/json");

// Dummy user ID (Replace with $_SESSION['userID'] once login is implemented)
$id = 1;

// Database Connection - will removed
$conn = new mysqli('localhost', 'root', '', 'ecohaven');
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Database connection failed"]));
}

// fetch user items
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM products WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
    $stmt->close();
    $conn->close();
    exit;
}

//Handle item listing (POST request)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $product = $_POST['product'];
    $category = $_POST['category'];
    $product_condition = $_POST['product_condition'];
    $location = $_POST['location'];

    // Upload Image
    $upload_folder = "uploadImage/";
    if (!is_dir($upload_folder)) {
        mkdir($upload_folder, 0777, true);
    }

    // unique image naming
    $image_name = time() . "_" . basename($_FILES["image"]["name"]);
    $image_path = $upload_folder . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
        $sql = "INSERT INTO products (full_name, product_name, category, product_condition, location, image, userID)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $product, $category, $product_condition, $location, $image_path, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Your item listed successfully!"]);
        } else {
            echo json_encode(["success" => false, "error" => $conn->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Error uploading image."]);
    }
}

$conn->close();
?>

<?php
include 'conn.php';

// Ensure the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['type'])) {
        die("Error: Missing form type.");
    }

    $type = $_POST['type'];

    switch ($type) {
        case 'comment':
            updateComment($conn);
            break;
        case 'recycle_event':
            updateRecycleEvent($conn);
            break;
        case 'join_event':
            updateJoinEvent($conn);
            break;
        case 'product':
            updateProduct($conn);
            break;
        case 'user':
            updateUser($conn);
            break;
        default:
            die("Error: Invalid type.");
    }
}

function updateComment($conn) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];  // Should match the input field 'date'
    $name = $_POST['name']; // Corrected to match the form's 'message' field

    if (empty($id) || empty($title) || empty($name)) {
        die("Error: All fields are required.");
    }

    $stmt = $conn->prepare("UPDATE community_group SET title = ?, name = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $name, $id);
    $stmt->execute();

    header("Location: adminpage.php");
    exit();
}

function updateRecycleEvent($conn) {
    $id = intval($_POST['id']);
    $date = $_POST['date'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (empty($id) || empty($date) || empty($name) || empty($title) || empty($description)) {
        die("Error: All fields are required.");
    }

    // $event_image = handleImageUpload('image', "recycle_event", "event_id", $id, $conn);

    $stmt = $conn->prepare("UPDATE recycle_event SET date = ?, name = ?, title = ?, description = ? WHERE event_id = ?");
    $stmt->bind_param("ssssi", $date, $name, $title, $description, $id);
    $stmt->execute();

    header("Location: adminpage.php"); // Redirect with the tab parameter
    exit();
}

function updateJoinEvent($conn) {
    $id = intval($_POST['id']);
    $name = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = intval($_POST['age']);
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE join_event SET name = ?, email = ?, phone = ?, age = ?, address = ? WHERE join_id = ?");
    $stmt->bind_param("sssisi", $name, $email, $phone, $age, $address, $id);
    $stmt->execute();

    header("Location: adminpage.php"); // Redirect with the tab parameter
    exit();
}

function updateProduct($conn) {
    $id = intval($_POST['id']);
    $full_name = $_POST['full_name'];
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $product_condition = $_POST['product_condition'];
    $location = $_POST['location'];

    if (empty($id) || empty($full_name) || empty($product_name) || empty($category) || empty($product_condition) || empty($location)) {
        die("Error: All fields are required.");
    }

    // $event_image = handleImageUpload('image', "products", "id", $id, $conn);

    $stmt = $conn->prepare("UPDATE products SET full_name = ?, product_name = ?, category = ?, product_condition = ?, location = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $full_name, $product_name, $category, $product_condition, $location, $id);
    $stmt->execute();

    header("Location: adminpage.php"); // Redirect with the tab parameter
    exit();
}

function updateUser($conn) {
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET uid = ?, email = ?, pwd = ? WHERE userID = ?");
    $stmt->bind_param("sssi", $username, $email, $password, $id);
    $stmt->execute();

    header("Location: adminpage.php"); // Redirect with the tab parameter
    exit();
}

// function handleImageUpload($fieldName, $table, $primaryKey, $id, $conn) {
//     $target_dir = "uploadImage/";
//     if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

//     $imageName = "";

//     if (!empty($_FILES[$fieldName]['name'])) {
//         $target_file = $target_dir . basename($_FILES[$fieldName]['name']);
//         if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target_file)) {
//             $imageName = basename($_FILES[$fieldName]['name']);
//         } else {
//             die("Error uploading image.");
//         }
//     } else {
//         $stmt = $conn->prepare("SELECT image FROM $table WHERE $primaryKey = ?");
//         $stmt->bind_param("i", $id);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         if ($row = $result->fetch_assoc()) {
//             $imageName = $row['image'];
//         }
//     }

//     return $imageName;
// }

// function redirect() {
//     header("Location: recycle_admin_main.php");
//     exit();
// }

mysqli_close($conn);
?>

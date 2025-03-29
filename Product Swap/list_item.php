<?php
session_start();
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['userID'])) {
    error_log("User ID is NOT SET in SESSION.");
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

// Debugging: Ensure user ID is set
$userID = $_SESSION['userID'];
error_log("Session User ID: " . $userID);

$conn = new mysqli('localhost', 'root', '', 'ecohaven');
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

// Fetch user items
$sql = "SELECT * FROM products WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$stmt->close();
$conn->close();

// Ensure no extraneous output before JSON
//duplicate JSON will not work gurl!!
//exit is to prevent extra output which could not parse to js
echo json_encode($products);
exit;

?>
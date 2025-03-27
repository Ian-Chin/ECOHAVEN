<?php
session_start(); // Start the session

header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'ecohaven';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Ensure user is logged in
if (!isset($_SESSION['userID'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$userID = $_SESSION['userID'];
error_log("Session User ID: " . $userID);

// Fetch exchangeable products (items NOT listed by the current user)
$exchangeSql = "SELECT id, userID, full_name, product_name, category, product_condition, location, image 
                FROM products 
                WHERE userID != ?";
$exchangeStmt = $conn->prepare($exchangeSql);
$exchangeStmt->bind_param("i", $userID);
$exchangeStmt->execute();
$exchangeResult = $exchangeStmt->get_result();

$exchangeProducts = [];
while ($row = $exchangeResult->fetch_assoc()) {
    $exchangeProducts[] = $row;
}

// Fetch user's own inventory (items listed by the current user)
$userInventorySql = "SELECT id, product_name FROM products WHERE userID = ?";
$userStmt = $conn->prepare($userInventorySql);
$userStmt->bind_param("i", $userID);
$userStmt->execute();
$userResult = $userStmt->get_result();

$userInventory = [];
while ($row = $userResult->fetch_assoc()) {
    $userInventory[] = $row;
}

// Send JSON response
echo json_encode([
    "exchangeProducts" => $exchangeProducts,
    "userInventory" => $userInventory
]);

$conn->close();
exit;
?>

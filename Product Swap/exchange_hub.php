<?php

header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'ecohaven';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Dummy user ID (Replace this with session ID later)
$currentUserId = 1;

// Fetch exchangeable products (items NOT listed by the current user)
$exchangeSql = "SELECT id, userID, full_name, product_name, category, product_condition, location, image 
                FROM products 
                WHERE userID != ?";
$exchangeStmt = $conn->prepare($exchangeSql);
$exchangeStmt->bind_param("i", $currentUserId);
$exchangeStmt->execute();
$exchangeResult = $exchangeStmt->get_result();

$exchangeProducts = [];
while ($row = $exchangeResult->fetch_assoc()) {
    $exchangeProducts[] = $row;
}

// Fetch user's own inventory (items listed by the current user)
$userInventorySql = "SELECT id, product_name FROM products WHERE userID = ?";
$userStmt = $conn->prepare($userInventorySql);
$userStmt->bind_param("i", $currentUserId);
$userStmt->execute();
$userResult = $userStmt->get_result();

$userInventory = [];
while ($row = $userResult->fetch_assoc()) {
    $userInventory[] = $row;
}

// Send both lists to frontend
echo json_encode([
    "exchangeProducts" => $exchangeProducts,
    "userInventory" => $userInventory
]);

$conn->close();

?>
<?php

header('Content-Type: application/json');

include 'dbh.inc.php'; // Include your database connection file

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['userItemId']) || !isset($data['exchangeProductId'])) {
    die(json_encode(["error" => "Invalid request"]));
}

$userItemId = $data['userItemId'];
$exchangeProductId = $data['exchangeProductId'];

$getUserData = "SELECT id, userID, full_name FROM products WHERE id IN (?, ?)";
$stmt = $conn->prepare($getUserData);
$stmt->bind_param("ii", $userItemId, $exchangeProductId);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[$row['id']] = $row;
}

if (!isset($items[$userItemId]) || !isset($items[$exchangeProductId])) {
    die(json_encode(["error" => "Products not found"]));
}

$originalUserId1 = $items[$userItemId]['userID'];
$originalUserId2 = $items[$exchangeProductId]['userID'];
$originalFullName1 = $items[$userItemId]['full_name'];
$originalFullName2 = $items[$exchangeProductId]['full_name'];

$swapSql = "UPDATE products 
            SET userID = CASE 
                WHEN id = ? THEN ? 
                WHEN id = ? THEN ? 
            END, 
            full_name = CASE 
                WHEN id = ? THEN ? 
                WHEN id = ? THEN ? 
            END
            WHERE id IN (?, ?)";

$swapStmt = $conn->prepare($swapSql);
$swapStmt->bind_param("iisiisiiii", 
    $userItemId, $originalUserId2, 
    $exchangeProductId, $originalUserId1, 
    $userItemId, $originalFullName2, 
    $exchangeProductId, $originalFullName1, 
    $userItemId, $exchangeProductId
);

if ($swapStmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Swap failed: " . $conn->error]);
}

$conn->close();


?>
<?php
header('Content-Type: application/json');
include('db.php');

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $data['name'];
    $price = $data['price'];
    $quantity = $data['quantity'];
    $category = $data['category'];
    $expiry = $data['expiry'] ?? null;

    $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, category, expiry) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $name, $price, $quantity, $category, $expiry);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'فشل إضافة المنتج']);
    }
    
    $stmt->close();
}

$conn->close();
?>

<?php
header('Content-Type: application/json');
include('db.php');

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $id = $data['id'];
    $name = $data['name'];
    $price = $data['price'];
    $quantity = $data['quantity'];
    $category = $data['category'];
    $expiry = $data['expiry'] ?? null;

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, quantity=?, category=?, expiry=? WHERE id=?");
    $stmt->bind_param("sdissi", $name, $price, $quantity, $category, $expiry, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'فشل تحديث المنتج']);
    }
    
    $stmt->close();
}

$conn->close();
?>

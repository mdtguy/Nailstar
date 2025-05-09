<?php
header('Content-Type: application/json');
include('db.php');

$search = $_GET['search'] ?? '';
$id = $_GET['id'] ?? null;

if ($id) {
    // جلب منتج واحد
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    echo json_encode($product ?: null);
} else {
    // جلب جميع المنتجات أو البحث
    $sql = "SELECT * FROM products";
    if ($search) {
        $sql .= " WHERE name LIKE ? OR category LIKE ?";
        $searchTerm = "%$search%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
    } else {
        $stmt = $conn->prepare($sql);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    echo json_encode($products);
}

$conn->close();
?>

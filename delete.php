<?php
header('Content-Type: application/json');
include('db.php');

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $data['id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'فشل حذف المنتج']);
    }
    
    $stmt->close();
}

$conn->close();
?>

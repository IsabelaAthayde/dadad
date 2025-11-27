<?php
include __DIR__ . '/conexao.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id'])) {
    echo json_encode(null);
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

echo json_encode($res->fetch_assoc());
?>

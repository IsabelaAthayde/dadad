<?php
include __DIR__ . '/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM horario_funcionamento WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

echo json_encode($res->fetch_assoc());
?>

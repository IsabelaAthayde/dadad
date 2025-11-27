<?php
include __DIR__ . "/conexao.php";

$id = intval($_POST['id']);
$status = intval($_POST['status']);

$sql = "UPDATE clientes SET status=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $id);

echo $stmt->execute() ? "OK" : "Erro ao atualizar status.";
?>

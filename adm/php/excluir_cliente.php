<?php
include __DIR__ . '/conexao.php';

if (!isset($_GET['id'])) {
    echo "ID não informado.";
    exit;
}

$id = intval($_GET['id']);

$sql = "DELETE FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

echo ($stmt->execute())
    ? "Cliente excluído com sucesso!"
    : "Erro ao excluir cliente: " . $conn->error;
?>

<?php
include __DIR__ . '/conexao.php';

$id   = intval($_POST['id'] ?? 0);
$nome = $_POST['nome'] ?? '';
$data = $_POST['data'] ?? '';
$hora = $_POST['hora'] ?? '';
$status = isset($_POST['status']) ? intval($_POST['status']) : null;

if (!$id || !$nome || !$data || !$hora) {
    echo "Preencha todos os campos!";
    exit;
}

if ($status === null) {
    
    $sql = "UPDATE clientes SET nome=?, data=?, hora=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $data, $hora, $id);
} else {
    
    $sql = "UPDATE clientes SET nome=?, data=?, hora=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nome, $data, $hora, $status, $id);
}

if ($stmt->execute()) {
    echo "Cliente alterado com sucesso!";
} else {
    echo "Erro ao alterar cliente: " . $conn->error;
}
?>

<?php
include __DIR__ . '/conexao.php';

$nome = $_POST['nome'] ?? '';
$data = $_POST['data'] ?? '';
$hora = $_POST['hora'] ?? '';

if (!$nome || !$data || !$hora) {
    echo "Preencha todos os campos.";
    exit;
}


$sql = "INSERT INTO clientes (nome, data, hora, status) VALUES (?, ?, ?, 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $data, $hora);

if ($stmt->execute()) {
    echo "Cliente cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>

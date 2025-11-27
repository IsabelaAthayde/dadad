<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

include __DIR__ . '/../../adm/php/conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$email || !$senha) {
    echo json_encode([
        "success" => false,
        "message" => "Preencha todos os campos."
    ]);
    exit;
}

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "Email não encontrado."
    ]);
    exit;
}

$usuario = $result->fetch_assoc();

if ($usuario['senha'] !== $senha) {
    echo json_encode([
        "success" => false,
        "message" => "Senha incorreta."
    ]);
    exit;
}


$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_email'] = $usuario['email'];

echo json_encode([
    "success" => true,
    "message" => "Login realizado com sucesso."
]);
exit;

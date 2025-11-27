<?php
include __DIR__ . '/conexao.php';

$id = $_POST['id'];
$inicio = $_POST['hora_inicio'];
$fim = $_POST['hora_fim'];

$sql = "UPDATE horario_funcionamento 
        SET hora_inicio=?, hora_fim=? 
        WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $inicio, $fim, $id);

echo $stmt->execute()
    ? "Horário atualizado com sucesso!"
    : "Erro ao atualizar: " . $conn->error;
?>

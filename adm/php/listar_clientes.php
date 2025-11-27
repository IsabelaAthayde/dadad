<?php
include __DIR__ . '/conexao.php';

$busca = $_GET['q'] ?? '';

if ($busca !== '') {
    $sql = "SELECT * FROM clientes 
            WHERE nome LIKE ? 
            OR data LIKE ? 
            OR hora LIKE ?
            ORDER BY data DESC, hora DESC";
    $like = "%$busca%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM clientes ORDER BY data DESC, hora DESC";
    $result = $conn->query($sql);
}

if ($result->num_rows > 0) {
    while ($c = $result->fetch_assoc()) {
        $data_br = date("d/m/Y", strtotime($c['data']));
        
        $status_text = (isset($c['status']) && intval($c['status']) === 1) ? "Ativo" : "Inativo";

        echo "<tr>
                <td>{$c['nome']}</td>
                <td>{$data_br}</td>
                <td>{$c['hora']}</td>
                <td>{$status_text}</td>
                <td class='acoes'>
                    <button class='editar' onclick=\"window.location.href='alterar_cliente.html?id={$c['id']}'\">
                        <i class='fa-solid fa-pen-to-square'></i>
                    </button>
                    <button class='excluir' onclick='excluirCliente({$c['id']})'>
                        <i class='fa-solid fa-trash-can'></i>
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Nenhum cliente encontrado.</td></tr>";
}
?>

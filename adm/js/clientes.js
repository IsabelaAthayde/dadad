function carregarClientes(filtro = "") {
    const url = filtro ? `../php/listar_clientes.php?q=${encodeURIComponent(filtro)}` 
                       : `../php/listar_clientes.php`;

    fetch(url)
        .then(res => res.text())
        .then(html => {
            document.querySelector('#tabela-clientes').innerHTML = html;
        })
        .catch(err => {
            alert('Erro ao carregar clientes: ' + err);
        });
}

function pesquisarClientes() {
    const termo = document.getElementById('buscar').value.trim();
    carregarClientes(termo);
}

function excluirCliente(id) {
    if (!confirm("Tem certeza que deseja excluir este cliente?")) return;

    fetch('../php/excluir_cliente.php?id=' + id)
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            carregarClientes();
        })
        .catch(err => alert("Erro ao excluir cliente: " + err));
}

window.onload = () => carregarClientes();

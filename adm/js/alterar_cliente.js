const params = new URLSearchParams(window.location.search);
const id = params.get("id");

if (!id) {
    alert("ID inválido");
    window.location.href = "clientes.html";
}

function carregarCliente() {
    fetch("../php/carregar_cliente.php?id=" + id)
        .then(res => res.json())
        .then(cliente => {
            if (!cliente) {
                alert("Cliente não encontrado");
                window.location.href = "clientes.html";
            }
            document.querySelector("#nome").value = cliente.nome;
            document.querySelector("#data").value = cliente.data;
            document.querySelector("#hora").value = cliente.hora;
            
            if (cliente.status !== null && typeof cliente.status !== "undefined") {
                document.querySelector("#status").value = cliente.status;
            }
        })
        .catch(err => alert("Erro ao carregar cliente: " + err));
}

function alterarCliente() {
    const form = document.getElementById("form-alterar");
    const dados = new FormData(form);
    dados.append("id", id);

    fetch("../php/alterar_cliente.php", {
        method: "POST",
        body: dados
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        window.location.href = "clientes.html";
    })
    .catch(err => alert("Erro ao alterar cliente: " + err));
}

window.onload = carregarCliente;

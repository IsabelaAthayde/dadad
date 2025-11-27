const form = document.getElementById("form-add-cliente");

form.addEventListener("submit", function (event) {
    event.preventDefault();

    const dados = new FormData(form);

    fetch("../php/adicionar_cliente.php", {
        method: "POST",
        body: dados
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        window.location.href = "clientes.html";
    })
    .catch(err => alert("Erro ao adicionar cliente: " + err));
});

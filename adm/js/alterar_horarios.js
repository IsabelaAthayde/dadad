const id = new URLSearchParams(window.location.search).get("id");

function carregar() {
    fetch("../php/carregar_horario.php?id=" + id)
        .then(r => r.json())
        .then(d => {
            document.querySelector("#dia_semana").value = d.dia_semana;
            document.querySelector("#hora_inicio").value = d.hora_inicio;
            document.querySelector("#hora_fim").value = d.hora_fim;
        })
        .catch(e => alert("Erro ao carregar: " + e));
}

function salvarAlteracao() {
    const dados = new FormData();
    dados.append("id", id);
    dados.append("hora_inicio", document.querySelector("#hora_inicio").value);
    dados.append("hora_fim", document.querySelector("#hora_fim").value);

    fetch("../php/alterar_horario.php", {
        method: "POST",
        body: dados
    })
    .then(r => r.text())
    .then(msg => {
        alert(msg);
        window.location.href = "horario_de_funcionamento.html";
    })
    .catch(e => alert("Erro ao atualizar: " + e));
}

window.onload = carregar;

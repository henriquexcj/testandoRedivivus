// script.js
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "processar.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                exibirMensagem(response.message);
            }
        };

        var formData = new FormData(this);
        xhr.send(formData);
    });
});

function exibirMensagem(mensagem) {
    var mensagemElement = document.createElement("div");
    mensagemElement.classList.add("msg");
    mensagemElement.textContent = mensagem;

    document.body.appendChild(mensagemElement);
}

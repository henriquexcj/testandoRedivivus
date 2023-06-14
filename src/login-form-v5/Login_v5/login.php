<?php
// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os valores enviados pelo formulário
    $username = $_POST["username"];
    $password = $_POST["pass"];

    // Validação das credenciais (substitua por sua própria lógica de validação)
    if ($username === "usuario" && $password === "senha") {
        // Login bem-sucedido
        echo "Login bem-sucedido!;
        window.location.href='../../indexadm.html'";
    } else {
        // Credenciais inválidas
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }
}
?>

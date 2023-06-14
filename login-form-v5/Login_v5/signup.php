<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores dos campos de entrada
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    // Verifica se os campos estão preenchidos
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Verifica se as senhas coincidem
        if ($password != $confirmPassword) {
            echo "As senhas não coincidem.";
        } else {
            // TODO: Adicione aqui a lógica para cadastrar o usuário no banco de dados
            // Você pode usar as variáveis $username, $email e $password para realizar a inserção no banco de dados
            // Após o cadastro, você pode redirecionar o usuário para a página de login
            // Exemplo de redirecionamento:
            header("Location: login.html");
            exit;
        }
    }
}
?>

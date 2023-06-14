<?php
require_once 'classes/usuarios.php';
$u = new Usuario;

if(isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmasenha = addslashes($_POST['confsenha']);

    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmasenha)) {
        $u->conectar("bdredivivus","aws.connect.psdb.cloud","k6tr9o139n7svyh6qj2d","pscale_pw_U7eejIxkqYEYEZlhbQgJOS61lyP6t9YuMQMsnh73LG5");
        if($u->msgErro == "") {
            if($senha == $confirmasenha) {
                if($u->cadastrar($nome, $telefone, $email, $senha)) {
                    echo 'Cadastrado com sucesso! Acesse para entrar!';
                } else {
                    echo 'Email já cadastrado';
                   
                }
            } else {
                echo 'Senhas diferentes em senha e confirmar senha!';
            }
        } else {
            echo 'Erro: '.$u->msgErro;
        }
    } else {
        echo 'Preencha todos os campos!';
    }
}
?>

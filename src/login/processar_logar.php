<?php
require_once 'classes/usuarios.php';
$u = new Usuario;
if(isset($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if(!empty($email) && !empty($senha)) {
        $u->conectar("bdredivivus","aws.connect.psdb.cloud","k6tr9o139n7svyh6qj2d","pscale_pw_U7eejIxkqYEYEZlhbQgJOS61lyP6t9YuMQMsnh73LG5");
        if($u->msgErro == ""){
            if($u->logar($email,$senha)) {
                echo "success";
            } else {
                echo "Email ou Senha estão incorretos!";
            }
        } else {
            echo "Erro: ".$u->msgErro;
        }
    } else {
        echo "Preencha todos os dados!";
    }
}
?>

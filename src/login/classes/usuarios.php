<?php

class Usuario {
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha) {
        try {
            $this->pdo = new PDO(
                "mysql:dbname=".$nome.";host=".$host.";charset=utf8mb4",
                $usuario,
                $senha,
                [
                    PDO::MYSQL_ATTR_SSL_CA => '/path/to/cacert.pem', // Substitua pelo caminho correto do certificado CA
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Define para não verificar o certificado do servidor
                ]
            );
        } catch (PDOException $e) {
            $this->msgErro = $e->getMessage();
        }
    }
    

    public function cadastrar($nome, $telefone, $email, $senha) {
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();

            return true;
        }
    }

    public function logar($email, $senha) {
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];

            return true;
        } else {
            return false;
        }
    }
}


?>
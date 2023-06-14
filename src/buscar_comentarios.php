<?php
// Configurações de conexão com o banco de dados
$db_host = 'aws.connect.psdb.cloud';
$db_username = 'k6tr9o139n7svyh6qj2d';
$db_password = 'pscale_pw_U7eejIxkqYEYEZlhbQgJOS61lyP6t9YuMQMsnh73LG5';
$db_name = 'bdredivivus';

// Estabelecer conexão com o banco de dados
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
$options = array(
  PDO::MYSQL_ATTR_SSL_CA => '/path/to/cacert.pem', // Substitua pelo caminho correto do certificado CA
  PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Define para não verificar o certificado do servidor
);
$pdo = new PDO($dsn, $db_username, $db_password, $options);

// Chamar a função para obter todos os comentários
$comentarios = obterComentarios();

// Retornar os comentários em formato JSON
header('Content-Type: application/json');
echo json_encode($comentarios);
?>



<?php
// Conexão com o banco de dados
$db_host = 'aws.connect.psdb.cloud';
$db_username = 'k6tr9o139n7svyh6qj2d';
$db_password = 'pscale_pw_U7eejIxkqYEYEZlhbQgJOS61lyP6t9YuMQMsnh73LG5';
$db_name = 'bdredivivus';

$dsn = "mysql:host=$db_host;dbname=$db_name";
$options = array(
  PDO::MYSQL_ATTR_SSL_CA => '/path/to/cacert.pem', // Substitua pelo caminho correto do certificado CA
  PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Define para não verificar o certificado do servidor
);

try {
  $pdo = new PDO($dsn, $db_username, $db_password, $options);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Função para criar um novo comentário
  function criarComentario($star, $name, $comment) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO comentarios (star, name, comment) VALUES (:star, :name, :comment)");
    $stmt->bindParam(':star', $star);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();
    return $pdo->lastInsertId();
  }

  // Função para obter todos os comentários
  function obterComentarios() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM comentarios ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Função para atualizar um comentário
  function atualizarComentario($id, $star, $name, $comment) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE comentarios SET star = :star, name = :name, comment = :comment WHERE id = :id");
    $stmt->bindParam(':star', $star);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  // Função para excluir um comentário
  function excluirComentario($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM comentarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }
} catch (PDOException $e) {
  // Em caso de erro na conexão com o banco de dados
  echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
}

// Código para salvar o comentário enviado pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $star = $_POST["star"];
  $name = $_POST["name"];
  $comment = $_POST["comment"];

  if ($star != 0 && $name !== '' && $comment !== '') {
    $result = criarComentario($star, $name, $comment);
    if ($result) {
      $response = array(
        'status' => 'success',
        'message' => 'Dados salvos com sucesso!'
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Erro ao salvar os dados no banco de dados.'
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      'status' => 'error',
      'message' => 'Preencha todos os campos!'
    );
    echo json_encode($response);
  }
}
?>

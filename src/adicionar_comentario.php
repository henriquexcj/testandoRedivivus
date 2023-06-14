<?php
require_once(__DIR__."/../vendor/autoload.php");
require_once("index.php");

function getComentarios() {
    global $pdo;


    // Conexão com o banco de dados (mesmo código que você já possui)
    
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
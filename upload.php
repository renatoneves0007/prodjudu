<?php
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo']) && isset($_POST['tipo'])) {
  $tipo = $_POST['tipo'];
  $arquivo = $_FILES['arquivo'];

  $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
  $nomeFinal = "{$tipo}-" . time() . "." . $extensao;

  $pasta = "uploads/";
  if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
  }

  $caminho = $pasta . $nomeFinal;

  if (move_uploaded_file($arquivo['tmp_name'], $caminho)) {
    echo "Arquivo '$nomeFinal' enviado com sucesso!";
    echo "<br><a href='index.html'>Voltar</a>";
  } else {
    echo "Erro ao enviar o arquivo.";
  }
} else {
  echo "Dados incompletos.";
}

<?php
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo'])) {
  $tipo = $_POST['tipo'] ?? 'desconhecido';
  $file = $_FILES['arquivo'];
  $dataHora = date("d/m/Y H:i:s");

  $nomeOriginal = basename($file['name']);
  $nomeSalvo = time() . "-" . preg_replace("/[^a-zA-Z0-9\.\-_]/", "_", $nomeOriginal);

  $caminhoDestino = "uploads/" . $nomeSalvo;

  if (move_uploaded_file($file['tmp_name'], $caminhoDestino)) {
    // Redireciona para index com parâmetros GET para mostrar resultado
    header("Location: index.html?" . $tipo . "=" . urlencode($dataHora) . "&file=" . urlencode($nomeSalvo));
    exit;
  } else {
    echo "Erro ao salvar o arquivo.";
  }
} else {
  echo "Nenhum arquivo enviado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Envio de Documento</title>
</head>
<body>
  <h2>Anexar Documento do Processo</h2>

  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo']) && isset($_POST['tipo'])) {
      date_default_timezone_set('America/Sao_Paulo');
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
        echo "<p style='color:green;'>Arquivo <strong>$nomeFinal</strong> enviado com sucesso em " . date('d/m/Y H:i:s') . ".</p>";
        echo "<p><a href='$caminho' download>📥 Baixar arquivo enviado</a></p>";
      } else {
        echo "<p style='color:red;'>Erro ao enviar o arquivo.</p>";
      }
    }
  ?>

  <form method="POST" enctype="multipart/form-data">
    <label for="tipo">Tipo de Documento:</label>
    <select name="tipo" id="tipo" required>
      <option value="">Selecione</option>
      <option value="peticao">Petição Inicial</option>
      <option value="contestacao">Contestação</option>
      <option value="razoes">Razões</option>
      <option value="contrarrazoes">Contrarrazões</option>
      <option value="sentenca">Sentença</option>
    </select><br><br>

    <input type="file" name="arquivo" required /><br><br>
    <button type="submit">Enviar</button>
  </form>
</body>
</html>

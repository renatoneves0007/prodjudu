<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Processo Judicial - Timeline</title>
  <link rel="stylesheet" href="estilo.css" />
</head>
<body>
  <div class="timeline-container">
    <h2>Linha do Tempo do Processo Judicial</h2>
    <div class="timeline">

      <?php
      $tipos = ['peticao' => 'Petição Inicial', 'contestacao' => 'Contestação', 'razoes' => 'Razões', 'contrarrazoes' => 'Contrarrazões', 'sentenca' => 'Sentença'];
      foreach ($tipos as $key => $label): 
        $filename = glob("uploads/{$key}-*.*");
        $anexado = $filename ? date("d/m/Y H:i:s", filemtime($filename[0])) : null;
      ?>
      <div class="event">
        <div class="event-content">
          <h3><?= $label ?></h3>
          <form method="POST" action="upload.php" enctype="multipart/form-data">
            <input type="file" name="arquivo" required />
            <input type="hidden" name="tipo" value="<?= $key ?>" />
            <button type="submit">Anexar</button>
          </form>

          <?php if ($anexado): ?>
            <div class="timestamp">Anexado em: <?= $anexado ?></div>
            <a class="download-link" href="<?= $filename[0] ?>" download>Baixar <?= $label ?></a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</body>
</html>

<?php
$perguntas = file('perguntas.txt', FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Perguntas</title>
</head>
<body>
    <h1>Todas as Perguntas</h1>
    <ul>
        <?php foreach ($perguntas as $pergunta): ?>
            <li><?php echo htmlspecialchars($pergunta); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="menu.php">Voltar</a>
</body>
</html>

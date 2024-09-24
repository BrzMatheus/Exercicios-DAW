<?php
$perguntas = file('perguntas.txt', FILE_IGNORE_NEW_LINES);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $novaPergunta = $_POST['pergunta'];
    if (isset($perguntas[$id])) {
        $perguntas[$id] = $novaPergunta;
        file_put_contents('perguntas.txt', implode(PHP_EOL, $perguntas));
        $message = 'Pergunta alterada com sucesso!';
    } else {
        $message = 'Pergunta não encontrada.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alterar Perguntas</title>
</head>
<body>
    <h1>Alterar Perguntas</h1>
    <form method="post">
        <label for="id">ID da Pergunta:</label>
        <input type="number" name="id" required>
        <label for="pergunta">Nova Pergunta:</label>
        <input type="text" name="pergunta" required>
        <button type="submit">Alterar</button>
    </form>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <a href="menu.php">Voltar</a>
</body>
</html>

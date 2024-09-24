<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pergunta = $_POST['pergunta'];
    $respostas = [
        $_POST['resposta1'],
        $_POST['resposta2'],
        $_POST['resposta3'],
        $_POST['resposta4']
    ];

   
    $linha = $pergunta . "|" . implode(",", $respostas) . "\n";

   
    file_put_contents('perguntas.txt', $linha, FILE_APPEND | LOCK_EX);
    echo "<p>Pergunta adicionada com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Pergunta</title>
</head>
<body>
    <h1>Criar Pergunta de Múltipla Escolha</h1>
    <form method="post">
        <label for="pergunta">Pergunta:</label><br>
        <input type="text" id="pergunta" name="pergunta" required><br><br>

        <label for="resposta1">Resposta 1:</label><br>
        <input type="text" id="resposta1" name="resposta1" required><br><br>

        <label for="resposta2">Resposta 2:</label><br>
        <input type="text" id="resposta2" name="resposta2" required><br><br>

        <label for="resposta3">Resposta 3:</label><br>
        <input type="text" id="resposta3" name="resposta3" required><br><br>

        <label for="resposta4">Resposta 4:</label><br>
        <input type="text" id="resposta4" name="resposta4" required><br><br>

        <input type="submit" value="Adicionar Pergunta">
    </form>
    <a href="index.php" class="menu">Voltar ao Menu Principal</a>
</body>
</html>

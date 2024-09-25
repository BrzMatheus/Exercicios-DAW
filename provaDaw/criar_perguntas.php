<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$nome = $_SESSION['nome'];
$perguntas_arquivo = "perguntas.txt";
$log_arquivo = "log.txt";

function registrarAcao($acao) {
    global $nome, $log_arquivo;
    $registro = "$nome $acao em " . date('Y-m-d H:i:s') . "\n";
    file_put_contents($log_arquivo, $registro, FILE_APPEND);
}

function contarPerguntas($arquivo) {
    if (file_exists($arquivo)) {
        $linhas = file($arquivo);
        return count($linhas) / 6;
    }
    return 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta = $_POST['pergunta'];
    $resposta1 = $_POST['resposta1'];
    $resposta2 = $_POST['resposta2'];
    $resposta3 = $_POST['resposta3'];
    $resposta4 = $_POST['resposta4'];
    $resposta_correta = $_POST['resposta_correta'];

    if (!empty($pergunta) && !empty($resposta1) && !empty($resposta2) && !empty($resposta3) && !empty($resposta4) && !empty($resposta_correta)) {
        $numero_pergunta = contarPerguntas($perguntas_arquivo) + 1;
        $conteudo = "Pergunta $numero_pergunta - $pergunta\n";
        $conteudo .= "a) $resposta1\n";
        $conteudo .= "b) $resposta2\n";
        $conteudo .= "c) $resposta3\n";
        $conteudo .= "d) $resposta4\n";
        $conteudo .= "Resposta Correta: " . strtolower($resposta_correta) . "\n";

        file_put_contents($perguntas_arquivo, $conteudo, FILE_APPEND);
        registrarAcao("criou uma pergunta");

        echo "<p>Pergunta criada com sucesso!</p>";
    } else {
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
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
    <form method="POST" action="">
        <label for="pergunta">Pergunta:</label>
        <input type="text" id="pergunta" name="pergunta" required>

        <label for="resposta1">Resposta A:</label>
        <input type="text" id="resposta1" name="resposta1" required>

        <label for="resposta2">Resposta B:</label>
        <input type="text" id="resposta2" name="resposta2" required>

        <label for="resposta3">Resposta C:</label>
        <input type="text" id="resposta3" name="resposta3" required>

        <label for="resposta4">Resposta D:</label>
        <input type="text" id="resposta4" name="resposta4" required>

        <label for="resposta_correta">Resposta Correta:</label>
        <select id="resposta_correta" name="resposta_correta" required>
            <option value="a">A)</option>
            <option value="b">B)</option>
            <option value="c">C)</option>
            <option value="d">D)</option>
        </select>

        <input type="submit" value="Criar Pergunta">
    </form>
    <a href="menu.php">voltar menu</a>
</body>
</html>

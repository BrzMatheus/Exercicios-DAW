<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$perguntas_arquivo = "perguntas.txt";
$mensagem = "";
$pergunta_encontrada = null;

function lerPerguntas($arquivo) {
    $perguntas = [];
    if (file_exists($arquivo)) {
        $linhas = file($arquivo);
        for ($i = 0; $i < count($linhas); $i += 6) {
            $pergunta = trim($linhas[$i]);
            $respostas = [
                trim($linhas[$i + 1]),
                trim($linhas[$i + 2]),
                trim($linhas[$i + 3]),
                trim($linhas[$i + 4])
            ];
            $resposta_correta = strtolower(substr(trim($linhas[$i + 5]), -1));
            $perguntas[] = ['pergunta' => $pergunta, 'respostas' => $respostas, 'correta' => $resposta_correta];
        }
    }
    return $perguntas;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero_questao'])) {
    $numero_questao = (int)$_POST['numero_questao'] - 1;
    $perguntas = lerPerguntas($perguntas_arquivo);

    if (isset($perguntas[$numero_questao])) {
        $pergunta_encontrada = $perguntas[$numero_questao];
    } else {
        $mensagem = "Questão não encontrada.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Pergunta</title>
</head>
<body>
    <h1>Pesquisar Pergunta</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="numero_questao">Número da Questão:</label>
        <input type="number" id="numero_questao" name="numero_questao" required min="1">
        <input type="submit" value="Pesquisar">
    </form>

    <?php if ($pergunta_encontrada): ?>
        <h3>Pergunta Encontrada:</h3>
        <p><?php echo $pergunta_encontrada['pergunta']; ?></p>
        <h4>Respostas Possíveis:</h4>
        <ul>
            <?php foreach ($pergunta_encontrada['respostas'] as $index => $resposta): ?>
                <li><?php echo chr(97 + $index) . ') ' . $resposta; ?></li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Resposta Correta:</strong> <?php echo strtoupper($pergunta_encontrada['correta']); ?></p>
    <?php endif; ?>
    <a href="menu.php">voltar menu</a>
</body>
</html>

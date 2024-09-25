<?php
session_start();
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$perguntas_arquivo = "perguntas.txt";
$log_arquivo = "log.txt";
$mensagem = "";
$perguntas = [];

function registrarAcao($usuario, $acao) {
    $data_hora = date('Y-m-d H:i:s');
    $registro = "$usuario $acao em $data_hora\n";
    file_put_contents("log.txt", $registro, FILE_APPEND);
}

function lerPerguntas($arquivo) {
    $perguntas = [];
    if (file_exists($arquivo)) {
        $linhas = file($arquivo);
        for ($i = 0; $i < count($linhas); $i += 6) {
            $pergunta = trim($linhas[$i]);
            $resposta1 = trim($linhas[$i + 1]);
            $resposta2 = trim($linhas[$i + 2]);
            $resposta3 = trim($linhas[$i + 3]);
            $resposta4 = trim($linhas[$i + 4]);
            $resposta_correta = trim($linhas[$i + 5]);
            $perguntas[] = [
                'pergunta' => $pergunta,
                'respostas' => [$resposta1, $resposta2, $resposta3, $resposta4],
                'correta' => strtolower(substr($resposta_correta, -1))
            ];
        }
    }
    return $perguntas;
}

function atualizarRespostas($arquivo, $index, $novas_respostas) {
    $linhas = file($arquivo);
    for ($i = 0; $i < count($novas_respostas); $i++) {
        $linhas[($index * 6) + 1 + $i] = "Resposta " . ($i + 1) . " - " . trim($novas_respostas[$i]) . "\n";
    }
    file_put_contents($arquivo, implode('', $linhas));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_questao = (int)$_POST['numero_questao'] - 1;
    $novas_respostas = [
        $_POST['resposta1'],
        $_POST['resposta2'],
        $_POST['resposta3'],
        $_POST['resposta4']
    ];
    atualizarRespostas($perguntas_arquivo, $numero_questao, $novas_respostas);
    registrarAcao($_SESSION['nome'], "atualizou as respostas da pergunta " . ($numero_questao + 1));
    $mensagem = "Respostas atualizadas com sucesso!";
}

$perguntas = lerPerguntas($perguntas_arquivo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Respostas da Pergunta</title>
</head>
<body>
    <div>
        <h1>Trocar Respostas da Pergunta</h1>
        <?php if ($mensagem): ?>
            <p><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="numero_questao">Número da Questão:</label>
            <input type="number" id="numero_questao" name="numero_questao" required min="1" max="<?php echo count($perguntas); ?>">

            <label for="resposta1">Nova Resposta 1:</label>
            <input type="text" id="resposta1" name="resposta1" required>

            <label for="resposta2">Nova Resposta 2:</label>
            <input type="text" id="resposta2" name="resposta2" required>

            <label for="resposta3">Nova Resposta 3:</label>
            <input type="text" id="resposta3" name="resposta3" required>

            <label for="resposta4">Nova Resposta 4:</label>
            <input type="text" id="resposta4" name="resposta4" required>

            <input type="submit" value="Atualizar Respostas">
        </form>

        <h3>Perguntas Disponíveis:</h3>
        <ul>
            <?php foreach ($perguntas as $index => $pergunta): ?>
                <li><?php echo ($index + 1) . '. ' . $pergunta['pergunta']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <a href="menu.php">Voltar ao menu</a>
</body>
</html>

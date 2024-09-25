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
$usuario = $_SESSION['nome'];

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

function atualizarPergunta($arquivo, $index, $nova_pergunta) {
    $linhas = file($arquivo);
    $linhas[$index * 6] = "Pergunta - $nova_pergunta\n";
    file_put_contents($arquivo, implode('', $linhas));
}

function registrarLog($usuario, $acao) {
    global $log_arquivo;
    $data_hora = date("Y-m-d H:i:s");
    $mensagem_log = "$usuario $acao em $data_hora\n";
    file_put_contents($log_arquivo, $mensagem_log, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_questao = (int)$_POST['numero_questao'] - 1;
    $nova_pergunta = $_POST['nova_pergunta'];
    if (!empty($nova_pergunta)) {
        atualizarPergunta($perguntas_arquivo, $numero_questao, $nova_pergunta);
        registrarLog($usuario, "alterou a pergunta " . ($numero_questao + 1) . " para: \"$nova_pergunta\".");
        $mensagem = "Pergunta atualizada com sucesso!";
    } else {
        $mensagem = "O novo enunciado não pode estar vazio.";
    }
}

$perguntas = lerPerguntas($perguntas_arquivo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Enunciado da Pergunta</title>
</head>
<body>
    <h1>Alterar Enunciado da Pergunta</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="numero_questao">Número da Questão:</label>
        <input type="number" id="numero_questao" name="numero_questao" required min="1" max="<?php echo count($perguntas); ?>">
        <label for="nova_pergunta">Novo Enunciado:</label>
        <input type="text" id="nova_pergunta" name="nova_pergunta" required>
        <input type="submit" value="Atualizar Pergunta">
    </form>

    <h3>Perguntas Disponíveis:</h3>
    <ul>
        <?php foreach ($perguntas as $index => $pergunta): ?>
            <li><?php echo ($index + 1) . '. ' . $pergunta['pergunta']; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="menu.php">Voltar ao Menu</a>
</body>
</html>

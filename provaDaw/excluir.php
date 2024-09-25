<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$perguntas_arquivo = "perguntas.txt";
$log_arquivo = "log.txt";
$mensagem = "";

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $index_excluir = (int)$_POST['excluir'];
    $perguntas = lerPerguntas($perguntas_arquivo);

    if (isset($perguntas[$index_excluir])) {
        $pergunta_excluida = $perguntas[$index_excluir]['pergunta'];
        unset($perguntas[$index_excluir]);
        $perguntas = array_values($perguntas);

        $conteudo = "";
        foreach ($perguntas as $pergunta) {
            $conteudo .= $pergunta['pergunta'] . "\n";
            foreach ($pergunta['respostas'] as $resposta) {
                $conteudo .= $resposta . "\n";
            }
            $conteudo .= "Resposta Correta: " . strtoupper($pergunta['correta']) . "\n";
        }
        file_put_contents($perguntas_arquivo, $conteudo);

        $nome_usuario = $_SESSION['nome'];
        $horario = date('Y-m-d H:i:s');
        $log_entry = "$nome_usuario - Pergunta excluída: \"$pergunta_excluida\" - Horário: $horario\n";
        file_put_contents($log_arquivo, $log_entry, FILE_APPEND);

        $mensagem = "Pergunta excluída com sucesso!";
    } else {
        $mensagem = "Pergunta não encontrada.";
    }
}

$perguntas = lerPerguntas($perguntas_arquivo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Pergunta</title>
</head>
<body>
    <h1>Excluir Pergunta</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <h3>Selecione a pergunta para excluir:</h3>
        <?php foreach ($perguntas as $index => $pergunta): ?>
            <fieldset>
                <legend><?php echo $pergunta['pergunta']; ?></legend>
                <input type="radio" name="excluir" value="<?php echo $index; ?>" required> Excluir
            </fieldset>
        <?php endforeach; ?>
        <input type="submit" value="Excluir Pergunta">
    </form>
    <br>
    <a href="menu.php">Voltar ao menu</a>
</body>
</html>

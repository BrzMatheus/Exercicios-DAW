<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$perguntas_arquivo = "perguntas.txt";
$gabarito = [];
$respostas_usuario = [];
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

function registrarLog($nomeUsuario) {
    $hora = date('Y-m-d H:i:s');
    $log = "$nomeUsuario confirmou resposta no formulário em $hora\n";
    file_put_contents('log.txt', $log, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $perguntas = lerPerguntas($perguntas_arquivo);
    
    foreach ($perguntas as $index => $pergunta) {
        $resposta_usuario = isset($_POST["resposta{$index}"]) ? $_POST["resposta{$index}"] : '';
        $respostas_usuario[$index] = $resposta_usuario;
        
        $gabarito[$index] = [
            'pergunta' => $pergunta['pergunta'],
            'correta' => $pergunta['correta'],
            'usuario' => $resposta_usuario
        ];
    }

    registrarLog($_SESSION['nome']);

    $mensagem = "<h2>Gabarito</h2><ul>";
    foreach ($gabarito as $index => $item) {
        $mensagem .= "<li>{$item['pergunta']} - Sua resposta: " . strtoupper($item['usuario']) . " | Correta: " . strtoupper($item['correta']) . " - " . ($item['usuario'] === $item['correta'] ? 'Correta' : 'Incorreta') . "</li>";
    }
    $mensagem .= "</ul>";
}

$perguntas = lerPerguntas($perguntas_arquivo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Perguntas</title>
</head>
<body>
    <h1>Responder Perguntas</h1>
    <form method="POST" action="">
        <?php foreach ($perguntas as $index => $pergunta): ?>
            <fieldset>
                <legend><?php echo $pergunta['pergunta']; ?></legend>
                <?php foreach ($pergunta['respostas'] as $key => $resposta): ?>
                    <label>
                        <input type="radio" name="resposta<?php echo $index; ?>" value="<?php echo strtolower(chr(97 + $key)); ?>" required>
                        <?php echo $resposta; ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <input type="submit" value="Enviar Respostas">
    </form>
    <?php if ($mensagem): ?>
        <div>
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>
    <a href="menu.php">Voltar ao menu</a>
</body>
</html>

<?php
session_start();

if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
    $log = "log.txt";
    $acao = "$nome saiu do sistema em " . date('Y-m-d H:i:s') . "\n";
    file_put_contents($log, $acao, FILE_APPEND);
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmado</title>
</head>
<body>
    <h1>Sessão Encerrada</h1>
    <p>Você encerrou sua sessão com sucesso.</p>
    <a href="login.php">Voltar ao Login</a>
</body>
</html>

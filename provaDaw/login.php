<?php
session_start();

$usuarios_arquivo = 'usuarios.txt';
$log_arquivo = 'log.txt';

function verificarUsuario($nome, $senha) {
    global $usuarios_arquivo;
    
    if (file_exists($usuarios_arquivo)) {
        $usuarios = file($usuarios_arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            list($usuario_nome, $usuario_senha) = explode(';', trim($usuario));
            if ($usuario_nome === $nome && $usuario_senha === $senha) {
                return true;
            }
        }
    }
    return false;
}

function registrarUsuario($nome, $senha) {
    global $usuarios_arquivo;
    $novo_usuario = "$nome;$senha\n";
    file_put_contents($usuarios_arquivo, $novo_usuario, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    
    if (!empty($nome) && !empty($senha)) {
        if (verificarUsuario($nome, $senha)) {
            $_SESSION['nome'] = $nome;
            $registro = "$nome entrou no sistema em " . date('Y-m-d H:i:s') . "\n";
            file_put_contents($log_arquivo, $registro, FILE_APPEND);
            header("Location: menu.php");
            exit();
        } else {
            registrarUsuario($nome, $senha);
            $_SESSION['nome'] = $nome;
            $registro = "$nome foi registrado e entrou no sistema em " . date('Y-m-d H:i:s') . "\n";
            file_put_contents($log_arquivo, $registro, FILE_APPEND);
            header("Location: menu.php");
            exit();
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ou Registro</title>
</head>
<body>
    <h1>Login ou Registro</h1>
    
    <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>
    
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        
        <input type="submit" value="Entrar ou Registrar">
    </form>
</body>
</html>

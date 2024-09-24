<?php
session_start();

function verificarLogin($nome, $senha) {
   
    if (!file_exists('usuarios.txt')) {
        return false; 
    }
    
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $usuario) {
        list($uNome, $uSenha) = explode(';', $usuario);
        if ($uNome == $nome && $uSenha == $senha) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    
    if (verificarLogin($nome, $senha)) {
        $_SESSION['usuario'] = $nome;
        header('Location: menu.php');
        exit();
    } else {
        
        $line = "$nome;$senha\n";
        file_put_contents('usuarios.txt', $line, FILE_APPEND);
        $_SESSION['usuario'] = $nome; 
        header('Location: menu.php'); 
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome de Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>

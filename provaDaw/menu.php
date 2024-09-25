<?php
session_start();
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$nome = $_SESSION['nome'];

// Função para registrar ações
function registrarAcao($acao) {
    $log = "log.txt";
    $nome = $_SESSION['nome'];
    $registro = "$nome $acao em " . date('Y-m-d H:i:s') . "\n";
    file_put_contents($log, $registro, FILE_APPEND);
}

// Registrar ações específicas baseadas nos cliques no menu
if (isset($_GET['acao'])) {
    registrarAcao($_GET['acao']);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .menu-container {
            padding: 20px;
            text-align: center;
            background: #fff;
            border-radius: 5px;
            width: 400px; 
        }

        .menu a {
            text-decoration: none;
            display: block;
            padding: 10px;
            background-color: #3498db;
            color: white;
            margin: 5px 0;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <section class="menu-container">
        <h1>Menu Principal</h1>
        <section class="menu">
            <a href="criar_perguntas.php?acao=Criou uma pergunta">Criar Perguntas</a>
            <a href="listar_perguntas.php?acao=Listou todas as perguntas">Responder Perguntas</a>
            <a href="listar_um.php?acao=Buscou uma pergunta">Buscar Pergunta</a>
            <a href="alterar_perguntas.php?acao=Alterou perguntas">Alterar Perguntas</a>
            <a href="alterar_respostas.php?acao=Alterou respostas">Alterar Respostas</a>
            <a href="excluir.php?acao=Excluiu perguntas">Excluir Perguntas</a>
            <a href="logout.php?acao=Encerrou a sessão">Encerrar Sessão</a>
        </section>
    </section>
</body>
</html>

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
            
            <a href="listar_perguntas.php">Listar Todos as perguntas</a>
            <a href="listar_um.php">Buscar Pergunta</a>
            <a href="alterar_perguntas.php">Alterar Perguntas</a>
            <a href="alterar_respostas.php">Alterar Respostas</a>
            <a href="criar_perguntas.php">Criar Perguntas</a>
            <a href="login.php">Encerrar sessao <a>
            <a href="excluir_perguntas.php">Excluir pergntas</a>
        </section>
    </section>
</body>
</html>

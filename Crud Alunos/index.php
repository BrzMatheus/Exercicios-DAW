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
            width: 400px; /* Tamanho do fundo branco */
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
            <a href="registrar.php">Incluir Aluno</a>
            <a href="listar_todos.php">Listar Todos os Alunos</a>
            <a href="listar_um.php">Buscar Aluno Específico</a>
            <a href="alterar_nome.php">Alterar Aluno</a>
            <a href="alterar_cpf.php">Alterar CPF</a>
            <a href="alterar_data.php">Alterar Data de Nascimento</a>
            <a href="alterar_matricula.php">Alterar Matricula</a>
      
            <a href="excluir.php">Excluir Aluno</a>
        </section>
    </section>
</body>
</html>

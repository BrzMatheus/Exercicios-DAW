<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
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
            padding: 80px; 
            text-align: center;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu a {
            text-decoration: none;
            padding: 15px 30px;
            background-color: #3498db;
            color: white;
            margin: 5px 0;
            border-radius: 3px;
            transition: background-color 0.3s;
            width: 100%;
            max-width: 300px;
        }

        .menu a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <section class="menu-container">
        <h1>Menu Disciplinas</h1>
        <section class="menu">
            <a href="registrar.php">Registrar Matéria</a>
            <a href="listar.php">Listar Matérias</a>
            <a href="alterar_nome.php">Alterar Nome</a>
            <a href="alterar_codigo.php">Alterar Código</a>
            <a href="alterar_carga_horaria.php">Alterar Carga Horária</a>
            <a href="excluir.php">Excluir Matéria</a>
        </section>
    </section>
</body>
</html>

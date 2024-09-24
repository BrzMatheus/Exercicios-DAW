<?php
function salvarAlunos($alunos) {
    $arquivo = fopen("alunos.txt", "w");
    foreach ($alunos as $aluno) {
        $linha = $aluno['nome'] . ";" . $aluno['cpf'] . ";" . $aluno['matricula'] . ";" . $aluno['data_nascimento'] . PHP_EOL;
        fwrite($arquivo, $linha);
    }
    fclose($arquivo);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alunos = [];

    if (file_exists("alunos.txt")) {
        $arquivo = fopen("alunos.txt", "r");
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(";", trim($linha));
            $alunos[] = [
                'nome' => $dados[0],
                'cpf' => $dados[1],
                'matricula' => $dados[2],
                'data_nascimento' => $dados[3],
            ];
        }
        fclose($arquivo);
    }

    $novoAluno = [
        'nome' => $_POST['nome'],
        'cpf' => $_POST['cpf'],
        'matricula' => $_POST['matricula'],
        'data_nascimento' => $_POST['data_nascimento'],
    ];
    
    $alunos[] = $novoAluno;
    salvarAlunos($alunos);
    $mensagem = "Aluno adicionado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Aluno</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        section {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .menu {
            display: block;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background-color: #888;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<section>
    <h1>Registrar Aluno</h1>
    
    <?php if (isset($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>

        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" required>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>

        <input type="submit" value="Adicionar Aluno">
    </form>
    
    <a href="index.php" class="menu">Voltar ao Menu Principal</a>
</section>

</body>
</html>

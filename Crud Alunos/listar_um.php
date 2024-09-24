<?php

function obterAlunos() {
    $alunos = [];
    if (file_exists("alunos.txt")) {
        $arquivo = fopen("alunos.txt", "r");
        while (($linha = fgets($arquivo)) !== false) {
            $linha = trim($linha);
            $dados = explode(";", $linha);
            $alunos[] = [
                'nome' => $dados[0],
                'cpf' => $dados[1],
                'matricula' => $dados[2],
                'data_nascimento' => $dados[3]
            ];
        }
        fclose($arquivo);
    }
    return $alunos;
}

function buscarAlunoPorMatricula($matricula) {
    $alunos = obterAlunos();
    foreach ($alunos as $aluno) {
        if ($aluno['matricula'] === $matricula) {
            return $aluno;
        }
    }
    return null;
}

$alunoEncontrado = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
    $alunoEncontrado = buscarAlunoPorMatricula($matricula);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Aluno por Matrícula</title>

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
    <h1>Buscar Aluno por Matrícula</h1>

    <form method="post" action="">
        <label for="matricula">Digite a Matrícula do Aluno:</label>
        <input type="text" id="matricula" name="matricula" placeholder="Insira a matrícula" required>
        <input type="submit" value="Buscar Aluno">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if ($alunoEncontrado): ?>
            <h2>Dados do Aluno Encontrado</h2>
            <p><strong>Nome:</strong> <?php echo $alunoEncontrado['nome']; ?></p>
            <p><strong>CPF:</strong> <?php echo $alunoEncontrado['cpf']; ?></p>
            <p><strong>Matrícula:</strong> <?php echo $alunoEncontrado['matricula']; ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo $alunoEncontrado['data_nascimento']; ?></p>
        <?php else: ?>
            <p style="color: red;">Aluno com matrícula <?php echo htmlspecialchars($matricula); ?> não encontrado!</p>
        <?php endif; ?>
    <?php endif; ?>

    <a href="index.php" class="menu">Voltar ao Menu Principal</a>
</section>

</body>
</html>

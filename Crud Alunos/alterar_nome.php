<?php

function salvarAlunos($alunos) {
    $arquivo = fopen("alunos.txt", "w");
    foreach ($alunos as $aluno) {
        $linha = $aluno['nome'] . ";" . $aluno['cpf'] . ";" . $aluno['matricula'] . ";" . $aluno['data_nascimento'] . PHP_EOL;
        fwrite($arquivo, $linha);
    }
    fclose($arquivo);
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['indice']) && isset($_POST['novo_nome'])) {
    $alunos = obterAlunos();
    $indice = $_POST['indice'];
    $novo_nome = $_POST['novo_nome'];

    if (isset($alunos[$indice])) {
        $alunos[$indice]['nome'] = $novo_nome;
        salvarAlunos($alunos);
        $mensagem = "Nome do aluno alterado com sucesso!";
    } else {
        $mensagem = "Índice inválido!";
    }
}

$alunos = obterAlunos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Nome do Aluno</title>
    
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
    <h1>Alterar Nome do Aluno</h1>

    <?php if (isset($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <?php if (count($alunos) > 0): ?>
        <form method="post" action="">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Matrícula</th>
                    <th>Data de Nascimento</th>
                    <th>Selecionar</th>
                </tr>
                <?php foreach ($alunos as $indice => $aluno): ?>
                    <tr>
                        <td><?php echo ($aluno['nome']); ?></td>
                        <td><?php echo ($aluno['cpf']); ?></td>
                        <td><?php echo ($aluno['matricula']); ?></td>
                        <td><?php echo ($aluno['data_nascimento']); ?></td>
                        <td><input type="radio" name="indice" value="<?php echo $indice; ?>" required></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <label for="novo_nome">Novo Nome do Aluno:</label>
            <input type="text" id="novo_nome" name="novo_nome" placeholder="Digite o novo nome" required>

            <input type="submit" value="Alterar Nome">
        </form>
    <?php else: ?>
        <p>Nenhum aluno registrado ainda.</p>
    <?php endif; ?>
    
    <a href="index.php" class="menu">Voltar ao Menu Principal</a>
</section>

</body>
</html>

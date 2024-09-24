<?php
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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Alunos</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        section {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <h1>Lista de Alunos</h1>
    
    <table>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Matrícula</th>
            <th>Data de Nascimento</th>
        </tr>
        <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                <td><?php echo htmlspecialchars($aluno['cpf']); ?></td>
                <td><?php echo htmlspecialchars($aluno['matricula']); ?></td>
                <td><?php echo htmlspecialchars($aluno['data_nascimento']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <a href="index.php" class="menu">Voltar ao Menu Principal</a>
</section>

</body>
</html>

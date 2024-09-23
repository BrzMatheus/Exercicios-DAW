<?php
$materias = [];

if (file_exists("materias.txt")) {

    $arquivo = fopen("materias.txt", "r");

    while (($linha = fgets($arquivo)) !== false) {

        $linha = trim($linha);

        $dados = explode(";", $linha);

        $materias[] = [
            'nome' => $dados[0],
            'codigo' => $dados[1],
            'carga_horaria' => $dados[2]
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
    <title>Listar Matérias</title>

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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
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
    <h1>Lista de Matérias</h1>

    <?php if (count($materias) > 0): ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Código</th>
                <th>Carga Horária</th>
            </tr>
            <?php foreach ($materias as $materia): ?>
                <tr>
                    <td><?php echo ($materia['nome']); ?></td>
                    <td><?php echo ($materia['codigo']); ?></td>
                    <td><?php echo ($materia['carga_horaria']); ?> horas</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma matéria registrada.</p>
    <?php endif; ?>

    <a href="index.php" class="menu">Voltar ao Menu</a>
</section>

</body>
</html>

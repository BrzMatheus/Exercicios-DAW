<?php

function salvarMaterias($materias) {
    $arquivo = fopen("materias.txt", "w");
    foreach ($materias as $materia) {
        $linha = $materia['nome'] . ";" . $materia['codigo'] . ";" . $materia['carga_horaria'] . PHP_EOL;
        fwrite($arquivo, $linha);
    }
    fclose($arquivo);
}

function obterMaterias() {
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
    return $materias;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['indice'])) {
    $materias = obterMaterias();
    $indice = $_POST['indice'];

    if (isset($materias[$indice])) {
        unset($materias[$indice]);
        $materias = array_values($materias);
        salvarMaterias($materias);
        $mensagem = "Exclusão feita com sucesso!";
    } else {
        $mensagem = "Índice inválido!";
    }
}

$materias = obterMaterias();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Matéria</title>
    
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
    <h1>Excluir Matéria</h1>

    <?php if (isset($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <?php if (count($materias) > 0): ?>
        <form method="post" action="">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Código</th>
                    <th>Carga Horária</th>
                    <th>Seleção</th>
                </tr>
                <?php foreach ($materias as $indice => $materia): ?>
                    <tr>
                        <td><?php echo ($materia['nome']); ?></td>
                        <td><?php echo ($materia['codigo']); ?></td>
                        <td><?php echo ($materia['carga_horaria']); ?> horas</td>
                        <td><input type="radio" name="indice" value="<?php echo $indice; ?>" required></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <input type="submit" value="Excluir Matéria">
        </form>
    <?php else: ?>
        <p>Nenhuma matéria registrada ainda.</p>
    <?php endif; ?>
    
    <a href="index.php" class="menu">Voltar ao Menu</a>
</section>

</body>
</html>

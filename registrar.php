<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $carga_horaria = $_POST['carga_horaria'];

    
    if (!empty($nome) && !empty($carga_horaria) && !empty($codigo)) {
        
        $dados = $nome . ";" . $codigo . ";" . $carga_horaria . PHP_EOL;

        $arquivo = fopen("materias.txt", "a");

        fwrite($arquivo, $dados);

        fclose($arquivo);

        $mensagem = "Registro feito com sucesso!";
    } else {

        $mensagem = "Preencha todos os campo!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Matéria</title>
    
</head>
<body>

<section >
    <h1>Registrar Matéria</h1>

    <?php if (isset($mensagem)): ?>
        <p>
            <?php echo $mensagem; ?>
        </p>
    <?php endif; ?>

    
    <form method="post" action="">
        <label>Nome da Disciplina:</label>
        <input type="text"  name="nome" placeholder="Ex: Requisitos" required>

        <label>Código da Disciplina:</label>
        <input type="text" name="codigo" placeholder="Ex: 2REQ" required>

        <label>Carga Horária :</label>
        <input type="number" name="carga_horaria" placeholder="Ex: 36" required>

        <input type="submit" value="Registrar Matéria">
    </form>

    </section>

</body>
</html>

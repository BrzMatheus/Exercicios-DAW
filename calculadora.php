<!DOCTYPE html>
<html>
<head>
    <title>Calculadora Simples</title>
</head>
<body>

    <h2>Calculadora Simples</h2>
    <form method="post">
        <label for="num1">Número 1:</label>
        <input type="number" name="num1" id="num1" required>
        <br><br>
        
        <label for="num2">Número 2:</label>
        <input type="number" name="num2" id="num2" required>
        <br><br>

        <label for="operacao">Operação:</label>
        <select name="operacao" id="operacao" required>
            <option value="adicao">Adição</option>
            <option value="subtracao">Subtração</option>
            <option value="multiplicacao">Multiplicação</option>
            <option value="divisao">Divisão</option>
        </select>
        <br><br>

        <input type="submit" name="calcular" value="Calcular">
    </form>

    <?php
    if (isset($_POST['calcular'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operacao = $_POST['operacao'];

        switch ($operacao) {
            case 'adicao':
                $resultado = $num1 + $num2;
                echo "<h3>Resultado: $num1 + $num2 = $resultado</h3>";
                break;
            case 'subtracao':
                $resultado = $num1 - $num2;
                echo "<h3>Resultado: $num1 - $num2 = $resultado</h3>";
                break;
            case 'multiplicacao':
                $resultado = $num1 * $num2;
                echo "<h3>Resultado: $num1 * $num2 = $resultado</h3>";
                break;
            case 'divisao':
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                    echo "<h3>Resultado: $num1 / $num2 = $resultado</h3>";
                } else {
                    echo "<h3>Erro: Divisão por zero não permitida.</h3>";
                }
                break;
            default:
                echo "<h3>Operação inválida.</h3>";
        }
    }
    ?>

</body>
</html>

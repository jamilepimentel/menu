<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Opções</title>
</head>

<body>
    <h2>Menu de Opções</h2>
    <form method="POST" action="">
        <label for="opcao">Escolha uma opção:</label>
        <select name="opcao" id="opcao" required>
            <option value="1">1 - Ver Saldo</option>
            <option value="2">2 - Depositar</option>
            <option value="3">3 - Sacar</option>
            <option value="4">4 - Sair</option>
        </select>
        <br><br>

        <label for="valor">Valor (apenas para depósito/saque):</label>
        <input type="number" name="valor" id="valor" step="any">
        <br><br>

        <input type="submit" value="Executar">
    </form>

    <?php
  
    session_start();
    if (!isset($_SESSION['saldo'])) {
        $_SESSION['saldo'] = 1000.00; 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcao = $_POST['opcao'];
        $valor = isset($_POST['valor']) ? floatval($_POST['valor']) : 0;

        switch ($opcao) {
            case "1":
                echo "<h3>Seu saldo atual é: R$ " . number_format($_SESSION['saldo'], 2, ',', '.') . "</h3>";
                break;

            case "2":
                if ($valor > 0) {
                    $_SESSION['saldo'] += $valor;
                    echo "<h3>Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!</h3>";
                    echo "<h3>Seu novo saldo é: R$ " . number_format($_SESSION['saldo'], 2, ',', '.') . "</h3>";
                } else {
                    echo "<h3>Por favor, insira um valor válido para depósito.</h3>";
                }
                break;

            case "3":
                if ($valor > 0 && $valor <= $_SESSION['saldo']) {
                    $_SESSION['saldo'] -= $valor;
                    echo "<h3>Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!</h3>";
                    echo "<h3>Seu novo saldo é: R$ " . number_format($_SESSION['saldo'], 2, ',', '.') . "</h3>";
                } elseif ($valor > $_SESSION['saldo']) {
                    echo "<h3>Saldo insuficiente para realizar o saque.</h3>";
                } else {
                    echo "<h3>Por favor, insira um valor válido para saque.</h3>";
                }
                break;

            case "4":
                echo "<h3>Obrigado por utilizar nosso sistema. Até logo!</h3>";
                session_destroy(); 
                break;

            default:
                echo "<h3>Opção inválida. Por favor, escolha uma opção válida.</h3>";
                break;
        }
    }
    ?>
    
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramentas SAEP</title>
</head>
<body>
<?php
$idProduto = $_GET['id'];
?>

<form action="../BE/movimentacaoProduto.php?id=$idProduto" method="POST">
    <label for="Tipo">Tipo de movimentação:</label><br>
    <select name="tipo" id="tipo" required>
        <option value="">Selecione...</option>
        <option value="entrada">Entrada</option>
        <option value="retirada">Retirada</option>
    </select><br><br>
    <label for="Movimentacao">Quantia Movimentada: </label><br>
    <input type="number" name="quantiaMovimentada" required>
</form>
    
</body>
</html>
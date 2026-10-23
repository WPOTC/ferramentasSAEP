<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramentas SAEP</title>
</head>
<link rel="stylesheet" href="../../CSS/formularios.css">
<body>
<?php
session_start();
$idProduto = $_GET['id'];
$idUsuario = $_SESSION['usuario_id'];

if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Você precisa estar logado para acessar essa página!');</script>";
    echo "<script>window.location.href='../../index.php';</script>";
}
?>

<a href="interfaceProdutos.php">Voltar</a>

<h1>Registro de Movimentação</h1>
<form action="../BE/movimentoProduto.php" method="POST">
    <label for="Tipo">Tipo de movimentação:</label><br>
    <select name="tipoMovimento" id="tipoMovimento" required>
        <option value="">Selecione...</option>
        <option value="entrada">Entrada</option>
        <option value="retirada">Retirada</option>
    </select><br><br>
    <label for="Movimentacao">Quantia Movimentada: </label><br>
    <input type="number" name="quantiaMovimentada" required><br><br><br>
    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
    <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
    <input type="submit" value="Registrar">
</form>
    
</body>
</html>
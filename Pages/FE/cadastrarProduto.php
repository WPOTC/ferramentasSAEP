<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramentas SAEP</title>
</head>

<?php

session_start();
if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Você precisa estar logado!');</script>";
    echo "<script></script>";
}

?>

<body>

<h1>Cadastro de Produto</h1>
<form action="../BE/cadastroProduto.php" method="POST">
    <label for="Nome">Nome do produto:</label><br>
    <input type="text" name="nomeProduto" required><br><br>
    <label for="Descricao">Descrição:</label><br>
    <textarea name="descricao" id="descricao" rows="10" cols="60" placeholder="Medidas, material, marca..."></textarea><br><br>
    <label for="Quantidade">Quantidade:</label><br>
    <input type="number" name="quantidade" required><br><br>
    <label for="QuantiaMinima">Quantia Mínima:</label><br>
    <input type="number" name="quantiaMinima" required><br><br>
    <input type="submit" value="Cadastrar">
</form>
    
</body>
</html>
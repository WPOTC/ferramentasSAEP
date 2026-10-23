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
if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Você precisa estar logado para acessar essa página!');</script>";
    echo "<script>window.location.href='../../index.php';</script>";
}

$id_produto = $_GET['id'];


require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/ProdutoController.php";

$pdo = getPDOConnection();
$produtoController = new ProdutoController($pdo);

$produto = $produtoController->exibirInformacoesProduto($id_produto);
?>

<h1>Edição de Produto</h1>

<form action="../BE/editProduto.php" method="POST">
    <label for="Nome">Nome do produto:</label><br>
    <input type="text" name="nomeProduto" value="<?= $produto['nome']; ?>"><br><br>
    <label for="Descricao">Descrição:</label><br>
    <textarea name="descricao" id="descricao" rows="10" cols="60" ><?= $produto['descricao']; ?></textarea><br><br>
    <label for="QuantiaMinima">Quantia Mínima:</label><br>
    <input type="number" name="quantiaMinima" value="<?= $produto['quantia_minima']; ?>"><br><br>
    <input type="hidden" name="idProduto" value="<?= $produto['id']; ?>">
    <input type="submit" value="Editar">
</form>
    
</body>
</html>
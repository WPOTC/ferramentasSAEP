<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/ProdutoController.php";
session_start();

$nome = $_POST['nomeProduto'];
$descricao = $_POST['descricao'];
$quantidade = $_POST['quantidade'];
$quantia_minima = $_POST['quantiaMinima'];

if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Acesso restrito!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "<script>alert('Siga o protocolo!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pdo = getPDOConnection();
    $produtoController = new ProdutoController($pdo);

    $produtoController->cadastrarProduto($nome, $descricao, $quantidade, $quantia_minima);
    header('Location: ../FE/interfaceProdutos.php');
}

?>
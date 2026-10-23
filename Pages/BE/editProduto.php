<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/ProdutoController.php";
session_start();

if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Acesso restrito!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "<script>alert('Siga o protocolo!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pdo = getPDOConnection();
    $produtoController = new ProdutoController($pdo);


    $id = $_POST['idProduto'];
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricao'];
    $quantia_minima = $_POST['quantiaMinima'];

    $produtoController->editarProduto($id, $nome, $descricao, $quantia_minima);
    header("Location: ../FE/interfaceProdutos.php");
}

?>
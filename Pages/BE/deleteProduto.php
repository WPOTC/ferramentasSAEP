<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/ProdutoController.php";

$id = $_GET['id'];

if(isset($id)){
    $pdo = getPDOConnection();
    $produtoController = new ProdutoController($pdo);

    $produtoController->excluirProduto($id);
    header("Location: ../FE/interfaceProdutos.php");
}else{
    header("Location: ../FE/interfaceProduto.php");
}

?>
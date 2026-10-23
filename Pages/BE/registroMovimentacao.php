<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/EstoqueController.php";

session_start();

if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Você precisa estar logado para acessar essa página!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}else{
    $pdo = getPDOConnection();
    $estoqueController = new EstoqueController($pdo);

    $id_usuario = $_GET['id_usuario'];
    $id_produto = $_GET['id_produto'];
    $tipo_movimento = $_GET['tipo_movimento'];
    $movimento = $_GET['movimento'];
    
    $estoqueController->registrarMovimentacao($id_usuario, $id_produto, $tipo_movimento, $movimento);
    header("Location: movimentoProduto.php?idProduto=" . urlencode($id_produto) .
    "&tipoMovimento=" . urlencode($tipo_movimento) .
    "&movimento=" . urlencode($movimento));
}

?>
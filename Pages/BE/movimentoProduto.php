<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/EstoqueController.php";

session_start();
if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Você precisa estar logado para acessar essa página!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pdo = getPDOConnection();
    $estoqueController = new EstoqueController($pdo);

    $id_usuario = $_POST['idUsuario'];
    $id_produto = $_POST['idProduto'];
    $tipo_movimento = $_POST['tipoMovimento'];
    $movimento = $_POST['quantiaMovimentada'];
    
    $estoqueController->movimentarProduto($id_produto, $tipo_movimento, $movimento);
    header("Location: registroMovimentacao.php?id_usuario=" . urlencode($id_usuario) . "&id_produto=" . urlencode($id_produto) . "&tipo_movimento=" . urlencode($tipo_movimento) . "&movimento=" . urlencode($movimento));
}else{
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}

?>
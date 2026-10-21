<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/UsuarioController.php";
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_SESSION['usuario_id'])){
        echo "<script>alert('Você já está logado!');</script>";
        echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>" ;   
    }else{
    $pdo = getPDOConnection();
    $usuarioController = new UsuarioController($pdo);

    $email = $_POST['email'];
    $senha = $_POST['senha'];
 
    $usuarioController->loginUsuario($email, $senha);
    header('Location: ../FE/interfaceProdutos.php');
    }
}

?>
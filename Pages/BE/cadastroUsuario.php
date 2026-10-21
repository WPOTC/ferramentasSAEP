<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/UsuarioController.php";
session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if($_SESSION['usuario_email'] !== 'adm@saep.com'){
    echo "<script>alert('Acesso restrito!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif(!$nome || !$email || !$senha || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "<script>alert('Siga os protocolos!');</script>";
    echo "<script>window.location.href='../FE/interfaceProdutos.php';</script>";
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pdo = getPDOConnection();
    $usuarioController = new UsuarioController($pdo);

    if($usuarioController->verificarEmailExistente($email)){
        echo "<script>alert('Este email já está em uso!');</script>";
        echo "<script>window.location.href='../FE/cadastrarUsuario.php';</script>";
    }else{

    $usuarioController->cadastrarUsuario($nome, $email, $senha);
    header('Location: ../FE/interfaceProdutos.php');

    }
}
?>
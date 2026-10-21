<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/UsuarioController.php";

$pdo = getPDOConnection();
$usuarioController = new UsuarioController($pdo);

$usuarioController->logoutUsuario();
header('Location: ../../index.php')

?>
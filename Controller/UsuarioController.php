<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Model/UsuarioModel.php";

class UsuarioController {
    private $usuarioModel;

    public function __construct($pdo){
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function verificarEmailExistente($email){
        return $this->usuarioModel->verificarEmailExistente($email);
    }

    public function cadastrarUsuario($nome, $email, $senha){
        return $this->usuarioModel->cadastrarUsuario($nome, $email, $senha);
    }

    public function loginUsuario($email, $senha){
        return $this->usuarioModel->loginUsuario($email, $senha);
    }

    public function logoutUsuario(){
        return $this->usuarioModel->logoutUsuario();
    }
}

?>
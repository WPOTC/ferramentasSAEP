<?php

class UsuarioModel {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function verificarEmailExistente($email){
        $sql = "SELECT COUNT(*) FROM usuario WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function cadastrarUsuario($nome, $email, $senha){
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        return $stmt->execute();
    }

    public function loginUsuario($email, $senha){
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam("senha", $senha);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if($usuario){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];

            return $usuario;
        }else{
            return "<script>alert('Email ou senha incorretos.');</script>";
        }
    }

    public function logoutUsuario(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        //limpei a sessão, e destruí ela depois, para garantir que o usuário seja deslogado corretamente
        $_SESSION = [];
        session_destroy();
    }
}

?>
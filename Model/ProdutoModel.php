<?php

class ProdutoModel {
    private $pdo;

    public function __construct($pdo){
        $this->pdo =$pdo;
    }

    public function cadastrarProduto($nome, $descricao, $quantidade, $quantia_minima){
        $sql = "INSERT INTO produto (nome, descricao, quantidade, quantia_minima) VALUES (:nome, :descricao, :quantidade, :quantia_minima)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':quantia_minima', $quantia_minima);
        return $stmt->execute();
    }

    public function listarProdutos(){
        $sql = "SELECT * FROM produto ORDER BY nome ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarProduto($id, $nome, $descricao, $quantia_minima){
        $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, quantia_minima = :quantia_minima WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':quantia_minima', $quantia_minima);
        return $stmt->execute();
    }

    public function excluirProduto($id){
        $sql = "DELETE FROM produto WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}

?>
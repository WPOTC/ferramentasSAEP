<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Model/ProdutoModel.php";

class ProdutoController{
    private $produtoModel;

    public function __construct($pdo){
        $this->produtoModel = new ProdutoModel($pdo);
    }

    public function cadastrarProduto($nome, $descricao, $quantidade, $quantia_minima){
        return $this->produtoModel->cadastrarProduto($nome, $descricao, $quantidade, $quantia_minima);
    }

    public function listarProdutos(){
        return $this->produtoModel->listarProdutos();
    }

    public function editarProduto($id, $nome, $descricao, $quantia_minima){
        return $this->produtoModel->editarProduto($id, $nome, $descricao, $quantia_minima);
    }

    public function excluirProduto($id){
        return $this->produtoModel->excluirProduto($id);
    }

    public function exibirInformacoesProduto($id){
        return $this->produtoModel->exibirInformacoesProduto($id);
    }
}

?>
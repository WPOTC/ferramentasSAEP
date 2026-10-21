<?php

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Model/EstoqueModel.php";

class EstoqueController{
    private $estoqueModel;

    public function __construct($pdo){
        $this->estoqueModel = new EstoqueModel($pdo);
    }

    public function listarHistoricoEntradas(){
        return $this->estoqueModel->listarHistoricoEntradas();
    }

    public function listarHistoricoRetiradas(){
        return $this->estoqueModel->listarHistoricoRetiradas();
    }

    public function registrarMovimentacao($id_usuario, $id_produto, $tipo_movimento, $movimento, $data_movimento){
        return $this->estoqueModel->registrarMovimentacao($id_usuario, $id_produto, $tipo_movimento, $movimento, $data_movimento);
    }

    public function movimentarProduto($id_produto, $tipo_movimento, $movimento, $quantidade){
    return $this->estoqueModel->movimentarProduto($id_produto, $tipo_movimento, $movimento, $quantidade);
    }


}

?>
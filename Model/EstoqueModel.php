<?php

class EstoqueModel{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function listarHistoricoEntradas(){
        $sql = "SELECT e.*, p.nome AS produto, u.nome AS usuario FROM estoque e
        INNER JOIN produto p ON e.id_produto = p.id
        INNER JOIN usuario u ON e.id_usuario = u.id
        WHERE e.tipo_movimento = 'entrada'
        ORDER by e.data_movimento DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    public function listarHistoricoRetiradas(){
        $sql = "SELECT e.*, p.nome AS produto, u.nome AS usuario FROM estoque e
        INNER JOIN produto p ON e.id_produto = p.id
        INNER JOIN usuario u ON e.id_usuario = u.id
        WHERE e.tipo_movimento = 'retirada'
        ORDER by e.data_movimento DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarMovimentacao($id_usuario, $id_produto, $tipo_movimento, $movimento, $data_movimento){
        $sql = "INSERT INTO estoque (id_usuario, id_produto, tipo_movimento, movimento, data_movimento) VALUES (:id_usuario, :id_produto, :tipo_movimento, :movimento, :data_movimento)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':tipo_movimento', $tipo_movimento);
        $stmt->bindParam(':movimento', $movimento);
        $stmt->bindParam(':data_movimento', $data_movimento);
        return $stmt->execute();
    }

    public function movimentarProduto($id_produto, $tipo_movimento, $movimento, $quantidade){
        $movimento = "SELECT movimento FROM estoque WHERE id_produto = :id_produto ORDER BY data_movimento DESC LIMIT 1";
        if($tipo_movimento === 'entrada'){
            $sql = "UPDATE produto SET quantidade = quantidade +" . $movimento . " WHERE id = :id_produto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_produto', $id_produto);
            $stmt->bindParam(':tipo_movimento', $tipo_movimento);
            $stmt->bindParam(':movimento', $movimento);
        }elseif($tipo_movimento === 'retirada'){
            $sqlVerificar = "SELECT COUNT(*) FROM estoque WHERE id_produto = :id_produto AND quantidade <" . $movimento;
            $stmtVerificar = $this->pdo->prepare($sqlVerificar);
            $stmtVerificar->bindParam(':id_produto', $id_produto);
            $stmtVerificar->bindParam(':quantidade', $quantidade);
            if ($stmtVerificar->execute()){
                return "<script>alert('Não é possível fazer a movimentação, pois a retirada é superior à quantidade atual.');</script>";
            }else{
                $sql = "UPDATE produto SET quantidade = quantidade -" . $movimento . " WHERE id = :id_produto";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id_produto', $id_produto);
                $stmt->bindParam(':tipo_movimento', $tipo_movimento);
                $stmt->bindParam(':movimento', $movimento);
            }
        }

        return $stmt->execute();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../../CSS/interface.css">
</head>
<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    echo "<script>alert('Você precisa estar logado para acessar essa página!');</script>";
    echo "<script>window.location.href='../../index.php';</script>";
}

require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/ProdutoController.php";
require_once "C:/Turma2/xampp/htdocs/ferramentasSAEP/Controller/EstoqueController.php";

$pdo = getPDOConnection();
$produtoController = new ProdutoController($pdo);
$estoqueController = new EstoqueController($pdo);

$produtos = $produtoController->listarProdutos();
$historicoEntrada = $estoqueController->listarHistoricoEntradas();
$historicoRetirada = $estoqueController->listarHistoricoRetiradas();


?>

<body>

<header>
    <h1>Seja bem vindo(a), <?php echo $_SESSION['usuario_nome']; ?></h1>
    <a href="../BE/logoutUsuario.php">Logout</a>
    <search>
      <form method="GET">
        <input name="search" type="text"> <button type="submit">Pesquisar</button>
      </form>
    </search>
</header>

<?php
if($_SESSION['usuario_email'] == 'adm@saep.com'){
  ?>
  <a href="cadastrarUsuario.php">Cadastrar Funcionário</a>
  <?php
}
?>
<br>

<?php

if(isset($_GET['search'])){
$pesquisa = $_GET['search'];
$sql = "SELECT * FROM produto WHERE nome LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%' OR quantidade LIKE '%$pesquisa%'";
$stmt = $pdo->prepare($sql);
$stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->execute();

?>

 <section>
 <h1>Resultado(s):</h1>

 <?php
    if($stmt->rowCount() == 0){
        echo "<h2>Nenhum resultado encontrado para '" . $pesquisa . "'.</h2>";
    }else{
        echo "<div class='pesquisas'>";
        while($resultados = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            foreach($resultados as $resultado){
                echo "<div class='resultado'>";
                echo "<p><h3>Nome:</h3> " . $resultado['nome'] . "</p>";
                echo "<p><h3>Descrição:</h3> " . $resultado['descricao'] . "</p>";
                echo "<p><h3>Quantidade:</h3> " . $resultado['quantidade'] . "</p>";
                echo "</div>";
            }
        }
        echo "</div>";
    }
    
    ?>
</section>

<?php
}
?>

<table>
  <tr>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Estoque (Quantia)</th>
    <th>Status</th>
    <th>Registrar Movimentação</th>
    <th>Editar Produto</th>
    <th>Deletar Produto</th>
  </tr>

  <?php
  foreach($produtos as $produto){
    ?>
  <tr>
    <td><?php echo $produto['nome']; ?></td>
    <td><?php echo $produto['descricao']; ?></td>
    <td><?php echo $produto['quantidade']; ?></td>
    <td><?php 
    if($produto['quantidade']<=$produto['quantia_minima']){
        echo "Estoque abaixo do recomendado!";
    }elseif($produto['quantidade']>$produto['quantia_minima']){
        echo "Estoque normal.";
    } ?></td>
    <td><a href="movimentarProduto.php?id=<?php echo $produto['id']; ?>"><img src="../../IMGs/botaoMovimentacao.webp" alt="botão de movimentação"></a></td>
    <td><a href="editarProduto.php?id=<?php echo $produto['id']; ?>"><img src="../../IMGs/botaoMovimentacao.webp" alt="botão de editar"></a></td>
    <td><a href="../BE/deleteProduto.php?id=<?php echo $produto['id']; ?>"  onclick="return confirm('Tem certeza?')"><img src="../../IMGs/botaoMovimentacao.webp" alt="botão de delete"></a></td>
  </tr>
  <?php
}
  ?>
  <tr><td><a href="cadastrarProduto.php"><h3>Adicionar Produto <img src="../../IMGs/botaoMais.png" alt="botão adicionar"></h3></a></td></tr>
</table>

<br><br><br><br><br><br>
<h1>Histórico:</h1>

<section>
<table>
  <tr><th>Entradas</th></tr>
  <tr>
    <th>Autor</th>
    <th>Produto</th>
    <th>Quantia movimentada</th>
    <th>Data da Movimentação</th>
  </tr>
  <?php
  foreach($historicoEntrada as $entrada){
?>
  <tr>
    <td><?php echo $entrada['usuario']; ?></td>
    <td><?php echo $entrada['produto']; ?></td>
    <td><?php echo $entrada['movimento']; ?></td>
    <td><?php echo $entrada['data_movimento']; ?></td>
  </tr>
  <?php
  }
  ?>
</table>
</section>

<section>
  <table>
    <tr><th>Retiradas</th></tr>
  <tr>
    <th>Autor</th>
    <th>Produto</th>
    <th>Quantia movimentada</th>
    <th>Data da Movimentação</th>
  </tr>
  <?php
  foreach($historicoRetirada as $retirada){
?>
  <tr>
    <td><?php echo $retirada['usuario']; ?></td>
    <td><?php echo $retirada['produto']; ?></td>
    <td><?php echo $retirada['movimento']; ?></td>
    <td><?php echo $retirada['data_movimento']; ?></td>
  </tr>
  <?php
  }
  ?>
  </table>
</section>
    
</body>
</html>
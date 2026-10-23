<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramentas SAEP</title>
    <link rel="stylesheet" href="../../CSS/formularios.css">
</head>
<?php
session_start();
if($_SESSION['usuario_email'] !== 'adm@saep.com'){
    echo "<script>alert('Acesso restrito!');</script>";
    echo "<script>window.location.href='interfaceProdutos.php';</script>";
}
?>
<body>

<a href="interfaceProdutos.php">Voltar</a>
    <h1>Cadastro de Funcionário</h1>
    <form action="../BE/cadastroUsuario.php" method="POST">
        <label for="Nome">Nome: </label><br>
        <input type="text" name="nome" required><br><br>
        <label for="Email">Email: </label><br>
        <input type="email" name="email" required><br><br>
        <label for="Senha">Senha: </label><br>
        <input type="password" name="senha" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>


</body>
</html>
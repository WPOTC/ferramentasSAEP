<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAEP - Ferramentas</title>
</head>
<link rel="stylesheet" href="CSS/formularios.css">
<body>
    <?php
    session_start();
    if(isset($_SESSION['usuario_id'])){
        echo "<script>alert('Você já está logado! Logout para logar em outra conta.');</script>";
        echo "<script>window.location.href='Pages/FE/interfaceProdutos.php';</script>";
    }
    ?>

<h1>Autenticação</h1>

<form action="Pages/BE/loginUsuario.php" method="POST">
    <label for="Email">Email: </label><br>
    <input type="email" name="email" required><br><br>
    <label for="Senha">Senha: </label><br>
    <input type="password" name="senha" required><br><br>

    <input type="submit" value="Login">
</form>
    
</body>
</html>
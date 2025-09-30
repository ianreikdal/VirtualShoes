<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso! <a href='login.php'>Faça login</a>";
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
<h2 class="text-center mb-4">Cadastro</h2>
<form method="post" action="">
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
</form>
</div>
</body>
</html>
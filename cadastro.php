<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $estado = $conn->real_escape_string($_POST['estado']);
    $cep = $conn->real_escape_string($_POST['cep']);

    $sql = "INSERT INTO usuarios (nome, email, senha, endereco, cidade, estado, cep) VALUES ('$nome', '$email', '$senha', '$endereco', '$cidade', '$estado', '$cep')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #00BFFF !important;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="css/css1.css">
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
    <div class="form-group">
        <label>Endereço</label>
        <input type="text" name="endereco" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Cidade</label>
        <input type="text" name="cidade" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Estado</label>
        <input type="text" name="estado" class="form-control" required>
    </div>
        <div class="form-group">
            <label>CEP</label>
            <input type="text" name="cep" class="form-control" required>
        </div>
    <button type="submit" class="btn btn-dark btn-block">Cadastrar</button>
        <p class="mt-3">Já tem conta? <a href="login.php">Faça login</a></p>
</form>
</div>
</body>
</html>
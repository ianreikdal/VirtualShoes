<?php
session_start();
include '../conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    $sql = "SELECT * FROM admins WHERE usuario='$usuario'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['admin'] = $admin['usuario']; // grava sessão
            header("Location: index.php"); // redireciona para painel
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Admin não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <a href="/index.php" class="btn btn-secondary">Voltar</a>
</head>
<body>
<div class="container mt-5" style="max-width:400px;">
    <h2 class="text-center mb-4">Login Admin</h2>

    <?php if($erro != ''): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label>Usuário</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-dark btn-block">Entrar</button>
    </form>
</div>
</body>
</html>
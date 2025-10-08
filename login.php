<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se é usuário normal
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $usuario = $res->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['id_usuario'];
            header("Location: index.php");
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="css/css1.css">

</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
<h2 class="text-center mb-4">Login</h2>
<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
<form method="post" action="">
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-dark btn-block">Entrar</button>
    <p class="mt-3">Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
</form>
</div>
</body>
</html>
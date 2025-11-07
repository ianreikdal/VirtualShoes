<?php
include 'conexao.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produto</title>
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        body {
            background-color: #00BFFF !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <?php
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM produtos WHERE id_produto = $id";
    $result = $conn->query($sql);
    ?>

    <?php if ($result->num_rows > 0): ?>
        <?php $p = $result->fetch_assoc(); ?>
        <div class="card shadow-sm">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><?= $p['nome'] ?></h3>
                        <p class="card-text"><?= $p['descricao'] ?></p>
                        <img src="<?= $p['imagem'] ?>" width="150">
                        <h4 class="text-success">R$ <?= number_format($p['preco'], 2, ',', '.') ?></h4>
                        <a href="carrinho.php?id=<?= $p['id_produto'] ?>" class="btn btn-success mt-3">
                            <i class="fas fa-cart-plus"></i> Adicionar ao carrinho
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Produto não encontrado.</div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left-circle-fill"></i> Voltar</a>
</div>
</body>
</html>

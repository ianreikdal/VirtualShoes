<?php
session_start();
include 'conexao.php';

$mensagem = "";

// Se o cliente finalizar a compra
if (isset($_POST['finalizar'])) {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];

    if (!empty($_SESSION['carrinho'])) {
        // Aqui seria a parte de salvar no banco em "pedidos" e "itens_pedido"
        // Por enquanto só vamos mostrar uma mensagem de sucesso
        $mensagem = "Pedido realizado com sucesso! Obrigado, $nome.";
        $_SESSION['carrinho'] = []; // limpa carrinho
    } else {
        $mensagem = "Seu carrinho está vazio!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="css/css1.css">

</head>
<body>
<div class="container mt-4">
    <h1><i class="fas fa-credit-card"></i> Checkout</h1>

    <?php if ($mensagem): ?>
        <div class="alert alert-info mt-3"><?= $mensagem ?></div>
        <a href="index.php" class="btn btn-primary mt-3"><i class="fas fa-home"></i> Voltar para Loja</a>
    <?php else: ?>
        <form method="post" class="mt-3">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço de entrega</label>
                <input type="text" id="endereco" name="endereco" class="form-control" required>
            </div>

            <button type="submit" name="finalizar" class="btn btn-success">
                <i class="fas fa-check"></i> Finalizar Pedido
            </button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>

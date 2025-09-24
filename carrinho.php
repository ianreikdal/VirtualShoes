<?php
session_start();
include 'conexao.php';

// Se o usuário clicou em "adicionar ao carrinho"
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]++;
    } else {
        $_SESSION['carrinho'][$id] = 1;
    }
}

// Se o usuário clicou para remover um item
if (isset($_GET['remover'])) {
    $id = intval($_GET['remover']);
    unset($_SESSION['carrinho'][$id]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>
    <div class="container mt-4">
        <h1><i class="fas fa-shopping-cart"></i> Meu Carrinho</h1>

        <?php if (!empty($_SESSION['carrinho'])): ?>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['carrinho'] as $id => $qtd):
                        $sql = "SELECT * FROM produtos WHERE id_produto = $id";
                        $result = $conn->query($sql);
                        $produto = $result->fetch_assoc();
                        $subtotal = $produto['preco'] * $qtd;
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?= $produto['nome'] ?></td>
                            <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            <td><?= $qtd ?></td>
                            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                            <td>
                                <a href="carrinho.php?remover=<?= $id ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3 class="text-right">Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
            <div class="text-right">
                <a href="checkout.php" class="btn btn-success">
                    <i class="fas fa-check"></i> Finalizar Compra
                </a>
                <a href="index.php" class="btn btn-primary">
                    <i class="bi bi-house"></i> Voltar às compras
                </a>
            </div>
        <?php else: ?>
            <div class="alert alert-warning mt-3">Seu carrinho está vazio.</div>
            <a href="index.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar às compras</a>
        <?php endif; ?>
    </div>
</body>

</html>
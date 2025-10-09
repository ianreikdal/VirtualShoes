<?php
include 'conexao.php';
session_start();
$quantidadeCarrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
$usuarioLogado = isset($_SESSION['usuario']);
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

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
    // Define mensagem de sucesso
    $_SESSION['msg_carrinho'] = "Produto adicionado ao carrinho!";
    // Redireciona para o index
    header("Location: index.php");
    exit;
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
    <link rel="stylesheet" href="css/css1.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00BFFF;">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="index.php">
                <i class="fas fa-store"></i> VirtShoes
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Início</a>
                    </li>
                    <?php if ($usuarioLogado): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="login.php">
                                <i class="bi bi-person-circle"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="admin/index.php">
                            <i class="fas fa-user-shield"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                        <th></th>
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
                                <a href="carrinho.php?remover=<?= $id ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja remover este item do carrinho?')">
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
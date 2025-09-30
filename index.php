<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>VirtShoes</title>
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="text-right mb-3">
            <a href="admin/index.php" class="btn btn-dark">
                <i class="fas fa-user-shield"></i> Admin
            </a>
            <a href="carrinho.php" class="btn btn-primary">
                <i class="bi bi-cart">Carrinho</i>
            </a>
            <a href="login.php" class="btn btn-primary">
                <i class="bi bi-person-plus">Login</i>
            </a>
        </div>
        <div class="row">
            <!-- aqui vai o loop de produtos -->
        </div>

        <h1 class="text-center mb-4"><i class="fas fa-store"></i> VirtShoes</h1>
        <div class="row">
            <?php
            $sql = "SELECT * FROM produtos WHERE ativo = 1";
            $result = $conn->query($sql);
            ?>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['nome'] ?></h5>
                                <img src="<?= $row['imagem'] ?>" width="150">
                                <p class="card-text">R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>
                                <a href="produto.php?id=<?= $row['id_produto'] ?>" class="btn btn-primary btn-block">
                                    <i class="fas fa-info-circle"></i> Ver detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Nenhum produto encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
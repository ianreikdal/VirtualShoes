    <?php include '../conexao.php';
    include 'protect.php';?> 

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Painel Admin - Produtos</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    </head>
    <body>
    <div class="container mt-4">
        <h1><i class="fas fa-box"></i> Produtos</h1>
        <a href="novo_produto.php" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Novo Produto
        </a>
        <a href="logout.php" class="btn btn-danger mb-3 float-right">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
        <a href="/index.php" class="btn btn-secondary mb-3 float-right">
            <i class="fas fa-sign-out-alt"></i> Volar
        </a>


        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM produtos";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['id_produto'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                    <td><?= $row['estoque'] ?></td>
                    <td>
                        <a href="editar_produto.php?id=<?= $row['id_produto'] ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="excluir_produto.php?id=<?= $row['id_produto'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="5">Nenhum produto cadastrado.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>

<?php
include '../conexao.php';
include 'protect.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM produtos WHERE id_produto = $id";
$result = $conn->query($sql);
$produto = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1><i class="fas fa-edit"></i> Editar Produto</h1>
        <form method="POST" action="atualizar_produto.php">
            <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" value="<?= $produto['nome'] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control"><?= $produto['descricao'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Preço</label>
                <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Estoque</label>
                <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" class="form-control" required>
            </div>
            <div class="form-group">
            <label>Imagem</label>
                <input type="file" name="imagem" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>
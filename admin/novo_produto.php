<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Produto</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1><i class="fas fa-plus"></i> Cadastrar Produto</h1>
    <form method="post" action="inserir_produto.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Estoque</label>
            <input type="number" name="estoque" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>

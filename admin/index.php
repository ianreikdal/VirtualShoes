<?php 
include '../conexao.php';
include 'protect.php';
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Produtos</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        /* Personalização do menu */
        .navbar {
            background-color: #00BFFF !important;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: white !important;
            transition: 0.3s;
        }
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 6px 12px;
        }
    </style>
</head>
<body>

<!-- MENU ADMIN -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-tools"></i> Painel Admin
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-box"></i> Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="novo_produto.php"><i class="fas fa-plus-circle"></i> Novo Produto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Ir para Loja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- FIM DO MENU ADMIN -->
<div class="container mt-4">
    <h1><i class="fas fa-box"></i> Produtos</h1>

    <table class="table table-bordered table-striped mt-3">
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
                    <a href="editar_produto.php?id=<?= $row['id_produto'] ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="excluir_produto.php?id=<?= $row['id_produto'] ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Tem certeza que deseja excluir?')">
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

<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
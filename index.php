<?php include 'conexao.php';
session_start();
$quantidadeCarrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
$usuarioLogado = isset($_SESSION['usuario']);
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>


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
    <link rel="stylesheet" href="css/css1.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="javascript" href="js/js.js">
</head>

<body>
    <!-- MENU DE NAVEGAÇÃO -->
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

        <li class="nav-item">
          <a class="nav-link text-white" href="carrinho.php">
            <i class="bi bi-cart"></i> Carrinho
            <?php if ($quantidadeCarrinho > 0): ?>
              <span class="badge badge-danger ml-1"><?= $quantidadeCarrinho ?></span>
            <?php endif; ?>
          </a>
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
        <div class="row">
            <!-- aqui vai o loop de produtos -->
        </div>
        <div>
            <h1 class="text-center mb-4"><i class="fas fa-store"></i> VirtualShoes</h1>
        </div>
        <!-- CARROSSEL DE IMAGENS -->
        <div id="carouselExampleIndicators" class="carousel slide mb-5 shadow" data-ride="carousel">
            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            <!-- Slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 rounded" src="img/banner1.jpg" alt="Primeiro slide">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                        <h5>Novidade na Loja!!!</h5>
                        <p> NOVA PRO 5 2025</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 rounded" src="img/banner2.jpg" alt="Segundo slide">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                        <h5>PROMOÇÃO POR AQUI!!!</h5>
                        <p>Confira  .</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 rounded" src="img/banner3.jpg" alt="Terceiro slide">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                        <h5>Frete Grátis</h5>
                        <p>Em compras acima de R$ 200!</p>
                    </div>
                </div>
            </div>

            <!-- Controles -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>

        <div class="row" class="card">
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
                                <p style="" class="card-text">R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>
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
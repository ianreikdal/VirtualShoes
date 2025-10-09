<?php include 'conexao.php';
session_start();
$quantidadeCarrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
$usuarioLogado = isset($_SESSION['usuario']);
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

if (isset($_SESSION['msg_carrinho'])) {
  echo '<div id="alert-carrinho" class="alert alert-success text-center" style="margin-top:90px;">' . $_SESSION['msg_carrinho'] . '</div>';
  unset($_SESSION['msg_carrinho']);
}
?>
<script>
  setTimeout(function() {
    var alert = document.getElementById('alert-carrinho');
    if (alert) {
      alert.style.display = 'none';
    }
  }, 3000);
</script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <style>
    /* Estilo base do menu */
    .navbar {
      background-color: #00BFFF !important;
      transition: all 0.4s ease;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      z-index: 9999;
      /* Sempre acima de tudo */
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

    /* Animações de scroll */
    .navbar.hidden {
      transform: translateY(-100%);
      opacity: 0;
    }

    .navbar.visible {
      transform: translateY(0);
      opacity: 1;
    }

    /* Espaço para compensar o menu fixo */
    body {
      padding-top: 80px;
    }
  </style>

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
  <nav id="mainNav" class="navbar navbar-expand-lg navbar-dark fixed-top py-3" style="transition: all 0.4s ease;">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-store"></i> VirtShoes
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
        aria-controls="navbar" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Início</a>
          </li>

          <li class="nav-item position-relative">
            <a class="nav-link" href="carrinho.php">
              <i class="fas fa-shopping-cart"></i> Carrinho
              <?php if ($quantidadeCarrinho > 0): ?>
                <span class="badge badge-pill badge-danger position-absolute"
                  style="top:0; right:0; transform:translate(50%,-50%);">
                  <?= $quantidadeCarrinho ?>
                </span>
              <?php endif; ?>
            </a>
          </li>

          <?php if ($usuarioLogado): ?>
            <li class="nav-item">
              <a class="nav-link text-danger" href="logout.php">
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
            <a class="nav-link" href="/admin/index.php">
              <i class="bi bi-person-lock"></i> Admin
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row">
      <!-- loop de produtos -->
    </div>
    <div>
      <h1 class="text-center mb-4" style="color: #00BFFF">Bem-vindo à VirtShoes!</h1>
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
            <p>Confira .</p>
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
  <script>
    let lastScrollTop = 0;
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", function() {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

      if (currentScroll <= 0) {
        // No topo — menu visível
        navbar.classList.remove("hidden");
        navbar.classList.add("visible");
      } else if (currentScroll > lastScrollTop) {
        // Rolando para baixo — esconde o menu
        navbar.classList.remove("visible");
        navbar.classList.add("hidden");
      } else {
        // Rolando para cima — mostra o menu
        navbar.classList.remove("hidden");
        navbar.classList.add("visible");
      }

      lastScrollTop = currentScroll;
    });
  </script>
  <script>
    let lastScrollTop = 0;
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", function() {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

      if (currentScroll <= 0) {
        // No topo — menu visível
        navbar.classList.remove("hidden");
        navbar.classList.add("visible");
      } else if (currentScroll > lastScrollTop) {
        // Rolando para baixo — esconde o menu
        navbar.classList.remove("visible");
        navbar.classList.add("hidden");
      } else {
        // Rolando para cima — mostra o menu
        navbar.classList.remove("hidden");
        navbar.classList.add("visible");
      }

      lastScrollTop = currentScroll;
    });
  </script>

</body>

</html>
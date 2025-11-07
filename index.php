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
    /* Estilo do rodapé */
    footer {
      background-color: #f8f9fa;
      text-align: center;
      padding: 20px 0;
      position: relative;
      bottom: 0;
      width: 100%;
      font-size: 14px;
      color: #6c757d;
    }
        /* Footer personalizado */
    .site-footer {
      background: #f8f9fa;
      border-top: 1px solid #e9ecef;
      padding: 40px 0 20px;
      color: #6c757d;
      margin-top: 40px;
    }
    .site-footer a { color: #495057; }
    .site-footer a:hover { color: #00BFFF; text-decoration: none; }
    .site-footer .footer-title {
      font-weight: 700;
      color: #343a40;
      margin-bottom: 12px;
    }
    .site-footer .social a {
      display: inline-block;
      margin-right: 10px;
      color: #495057;
      font-size: 18px;
    }
    .site-footer .social a:hover { color: #00BFFF; }
    .site-footer .newsletter input[type="email"]{
      max-width: 320px;
      display: inline-block;
    }
    .site-footer .back-to-top {
      position: fixed;
      right: 20px;
      bottom: 20px;
      z-index: 2000;
      display: none;
    }
    @media (max-width: 575.98px) {
      .site-footer .newsletter-form { text-align: left; }
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
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-3">
        <h5 class="footer-title"><i class="fas fa-store"></i> VirtShoes</h5>
        <p>Loja especializada em calçados com as melhores marcas. Atendimento rápido e frete ágil.</p>
        <p class="mb-0"><strong>Endereço:</strong> Rua Exemplo, 123 - Cidade</p>
        <p><strong>Telefone:</strong> (11) 99999-9999</p>
      </div>

      <div class="col-md-3 mb-3">
        <h6 class="footer-title">Navegação</h6>
        <ul class="list-unstyled">
          <li><a href="index.php">Início</a></li>
          <li><a href="produto.php">Produtos</a></li>
          <li><a href="carrinho.php">Carrinho</a></li>
          <li><a href="login.php">Minha conta</a></li>
        </ul>
      </div>

      <div class="col-md-3 mb-3">
        <h6 class="footer-title">Suporte</h6>
        <ul class="list-unstyled">
          <li><a href="#">Perguntas frequentes</a></li>
          <li><a href="#">Política de trocas</a></li>
          <li><a href="#">Termos e Condições</a></li>
        </ul>
      </div>

      <div class="col-md-2 mb-3">
        <h6 class="footer-title">Siga-nos</h6>
        <div class="social mb-2">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
        <h6 class="footer-title">Newsletter</h6>
        <form class="newsletter-form" action="#" method="post" onsubmit="alert('Obrigado! Inscrição recebida.'); return false;">
          <div class="form-group mb-0">
            <input type="email" name="email" class="form-control form-control-sm" placeholder="Seu email" required>
            <button type="submit" class="btn btn-primary btn-sm mt-2">Inscrever</button>
          </div>
        </form>
      </div>
    </div>

    <hr>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
      <small class="mb-2 mb-md-0">© <?= date('Y') ?> VirtShoes. Todos os direitos reservados.</small>
      <div>
        <a href="#" class="mr-3">Política de Privacidade</a>
        <a href="#">Contato</a>
      </div>
    </div>
  </div>

  <button class="btn btn-primary back-to-top" id="backToTop" title="Voltar ao topo">
    <i class="fas fa-arrow-up"></i>
  </button>
</footer>

<script>
  // Mostrar botão "back to top" ao rolar
  const backBtn = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) backBtn.style.display = 'block';
    else backBtn.style.display = 'none';
  });
  backBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
</script>
</html>
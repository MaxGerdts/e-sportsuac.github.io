<?php
session_start();
include '../includes/head.php';
if (isset($_SESSION['autorizado'])) {
  $autorizado = $_SESSION['autorizado'];
  if ($autorizado == false) {
    $var_user = "Iniciar sesión";
    $href = "login.php";
    $color = "";
  }else{
    $href = "admin/inscription.php";
    $email = $_SESSION['user'];
    $var_user = $email;
    $color = "";
  }
}else{
  $var_user = "Iniciar sesión";
  $href = "login.php";
  $color = "";
}
?>
<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="../index.php">E-Sports UAC</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="../index.php#about">Sobre nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="../index.php#services">Clubes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="../index.php#contact">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="ranking.php">Ranking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="#">FAQ</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link js-scroll-trigger nav-red dropdown-toggle dropdown-profile" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Perfil
            </a>
            <div class="dropdown-menu dropdown-item-profile" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="admin/inscription.php">Configuración</a>
              <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href=<?php echo $href ?>><?php echo $var_user ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="signin.php">Registrate</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="masthead">
    <div class="faq-container">
      <div class="faq-content-game-logo"></div>
      <div class="faq-content-info">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="faq-content-esportsuac-logo">
        <img class="img-fluid" src="#" alt="t">
      </div>
    </div>
  </header>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="../assets/js/creative.min.js"></script>
</body>
</html>

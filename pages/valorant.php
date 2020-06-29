<?php session_start();
include '../includes/head.php';
if (isset($_SESSION['autorizado'])) {
  $autorizado = $_SESSION['autorizado'];
  if ($autorizado == false) {
    $var_user = "Iniciar sesión";
    $href = "pages/login.php";
    $color = "";
  }else{
    $href = "#";
    $email = $_SESSION['user'];
    $var_user = $email;
    $color = "";
  }
}else{
  $var_user = "Iniciar sesión";
  $href = "pages/login.php";
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
            <a class="nav-link js-scroll-trigger nav-red" href="../index.php#services">Ligas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="../index.php#contact">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="ranking.php">Ranking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="faq.php">FAQ</a>
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
            <a class="nav-link js-scroll-trigger nav-red" href="pages/signin.php">Registrate</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="masthead">
    <div class="valorant-container">
      <div class="valorant-content-game-logo"></div>
      <div class="valorant-content-info">
        Imagina esto: un juego de disparos táctico que se combina con poderes sobrenaturales. Todos tienen armas y habilidades únicas. ¿Cómo derrotas a enemigos con la velocidad del viento? Usa tu astucia para disparar primero y derrotarlos a tu estilo. VALORANT es un juego para estrategas valientes que se atreven a realizar jugadas inesperadas, porque si te ayudan a conseguir la victoria, funcionan.
        Los Shooters también han sido parte importante de los deportes electronicos, como CS:GO, Overwatch, Team Fortress 2, y más. Este nuevo juego recien salido del horno de Riot Games promete demasiado en el mundo de los E-Sports, a diferencia de los shooters tradicionales este requiere de mucha concentración y trabajo en equipo.
        Al igual que League of Legends, es gratis y presenta modalidad 5 vs 5 ¿Deseas ser uno de los primeros en representar a la Universidad Autonoma del Caribe o a un equipo profesional? Si tienes el nivel necesario llegarás muy lejos.
      </div>
      <div class="valorant-content-esportsuac-logo">
        <img class="img-fluid" src="../assets/img/icons/Logo-transparente.png" alt="Valorant">
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

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
            <a class="nav-link js-scroll-trigger nav-red" href="signin.php">Registrate</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="masthead">
    <div class="smash-container">
      <div class="smash-content-game-logo"></div>
      <div class="smash-content-info">
        Super Smash Bros siempre se ha caracterizado por ser considerado un juego hecho para la diversión entre amigos, las risas e incluso considerado Family Friendly ¿La realidad? Uno de los Fighting Games más aclamados y jugados en la actualidad.
        En la ciudad de Barranquilla se han llevado acabo torneos locales casi todos los sábados desde el año 2018 organizado por diferentes equipos y clanes que apuestan todo por el honor de ser reconocidos en Colombia.
        A diferencia de League of Lengeds y Valorant, Super Smash Bros no cuenta con sistema de rankeo propio de la compañia Nintendo, en cambio los organizadores de torneos locales, nacionales e internacionales se han puesto de acuerdo para llevar acabo un sistema
        de puntos y ranking que cambia constantemente debido a tantos torneos que se llevan acabo.
        ¿Que necesitas? No es ni necesario un Nintendo Switch, la comunidad de Super Smash Bros. Ultimate de la Universidad Autonoma del Caribe es muy grande y siempre están felices de recibir nuevas personas interesadas y enseñarles las mecánicas del juego.
      </div>
      <div class="smash-content-esportsuac-logo">
        <img class="img-fluid" src="../assets/img/icons/Logo-transparente.png" alt="Smash">
      </div>
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

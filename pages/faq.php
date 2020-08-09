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
      <div class="faq-content-info">
        <p>¿Que son los deportes electronicos?</p>
        <span>Son campeonatos de videojuegos (con vertientes online y presencial) en los que jugadores profesionales compiten por premios económicos y prestigio. También se les conoce como esports, pero la Real Academia Española recomienda el uso de la expresión española 'deporte electrónico', al igual que ocurre con el e-commerce o comercio electrónico.</span>
        <p>¿Pero si es un deporte?</p>
        <span>¡Claro que si! Los deportistas entienden la importancia de la disciplina, la práctica e incluso el trabajo en equipo, muchas de las cuales también tienen que aplicar los deportistas electrónicos.</span>
        <p>¿Que beneficios obtengo perteneciendo a E-Sports UAC?</p>
        <span>La Universidad Autonoma del Caribe busca apoyar a los usuarios interesados en los deportes electronicos, ofreciendo posibles lugares de práctica y recreación, así como beneficiar con posibles becas a los mejores jugadores</span>
        <p>¿Que tengo que hacer para inscribirme?</p>
        <span>Sólo necesitas tu correo institucional @uac.edu.co, dar click donde dice REGISTRAR y seguir los pasos ¡Te esperamos!</span>
      </div>
  </header>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="../assets/js/creative.min.js"></script>
</body>
</html>

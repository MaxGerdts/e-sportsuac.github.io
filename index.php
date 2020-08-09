<?php
session_start();
if (isset($_SESSION['autorizado'])) {
  $autorizado = $_SESSION['autorizado'];
  if ($autorizado == false) {
    $var_user = "Iniciar sesión";
    $href = "pages/login.php";
    $color = "";
  }else{
    $href = "pages/admin/inscription.php";
    $email = $_SESSION['user'];
    $var_user = $email;
    $color = "";
  }
}else{
  $var_user = "Iniciar sesión";
  $href = "pages/login.php";
  $color = "";
}
/*if ($autorizado == false) {

}else{

}*/
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>E-Sports UAC</title>
  <link rel="icon" type="image/png" href="assets/img/icons/logo.png" sizes="32x32">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="assets/css/creative.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">E-Sports UAC</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="pages/ranking.php">Ranking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger nav-red" href="pages/faq.php">FAQ</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link js-scroll-trigger nav-red dropdown-toggle dropdown-profile" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Perfil
            </a>
            <div class="dropdown-menu dropdown-item-profile" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="pages/admin/inscription.php">Configuración</a>
              <a class="dropdown-item" href="pages/logout.php">Cerrar sesión</a>
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
  <header class="masthead main">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Tu vida Gamer empieza aquí</h1>
          <hr class="divider my-4 divider-red">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">¡Bienvenido a E-Sports UAC!</p>
          <a class="btn btn-xl js-scroll-trigger btn-us" href="#services">Conoce más sobre nosotros</a>
        </div>
      </div>
    </div>
  </header>
  <section class="page-section bg-ligues" id="services">
    <div class="container">
      <h2 class="text-center mt-0">Conoce nuestros clubes</h2>
      <hr class="divider my-4 divider-red">
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <div class="icon-mobas"></div>
            <h3 class="h4 mb-2">Mobas</h3>
            <p class="text-muted mb-0">Clubes de Mobas</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <div class="icon-shooters"></div>
            <h3 class="h4 mb-2">Shooters</h3>
            <p class="text-muted mb-0">Clubes de Shooters.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <div class="icon-fightings"></div>
            <h3 class="h4 mb-2">Fighting Games</h3>
            <p class="text-muted mb-0">Clubes de Fighting Games</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="page-section bg-games" id="games">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <a href="pages/league-of-legends.php">
            <img src="assets/img/portfolio/thumbnails/League-Of-Legends.jpg" class="d-block w-100" alt="...">
          </a>
        </div>
        <div class="carousel-item">
          <a href="pages/valorant.php">
            <img src="assets/img/portfolio/thumbnails/Valorant.png" class="d-block w-100" alt="...">
          </a>
        </div>
        <div class="carousel-item">
          <a href="pages/super-smash-bros.php">
            <img src="assets/img/portfolio/thumbnails/Super-Smash.jpg" class="d-block w-100" alt="...">
          </a>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">¡Contactanos!</h2>
          <hr class="divider my-4 divider-red">
          <p class="text-muted mb-5">¿Tienes dudas o inquietudes sobre los clubes de deportes electrónicos de la Universidad Autónoma del Caribe?</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div class="contact-info">
            <a href="tel:53853400">PBX: +57 5 3853400</a>
          </div>
          <div class="contact-info">
            <a href="tel:">Operador Móvil Tigo #286</a>
          </div>
          <div class="contact-info">
            <a href="tel:018000918286">Línea gratuita 018000 918 286</a>
          </div>
        </div>
        <div class="col-lg-4 mr-auto text-center contact-info">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <a class="d-block" href="mailto:contact@yourwebsite.com">e-sportsuac@uac.edu.co</a>
        </div>
      </div>
    </div>
  </section>
    <footer class="bg-light py-5">
      <div class="container">
        <div class="small text-center text-muted">E-Sport UAC Todos los derechos reservados 2020</div>
      </div>
    </footer>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/creative.min.js"></script>
  </body>
  </html>

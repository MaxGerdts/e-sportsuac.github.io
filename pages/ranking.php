<?php session_start();
include '../includes/head.php';
if(!isset($_SESSION))
    {
        session_start();
    }
include 'config.php';
include 'functions.php';
$userClass = new userClass();
$ligaCheck = false;
$programaCheck = false;
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
if (isset($_POST['liga-select'])) {
  $liga = $_POST['liga-select'];
  if ($liga=="" || $liga=="Seleccione una liga") {
    $ligaCheck = false;
  }else{
    $ligaCheck = true;
  }
}
if (isset($_POST['programa-select'])) {
  $programa = $_POST['programa-select'];
  if ($programa=="" || $programa == "Seleccione un programa") {
    $programaCheck = false;
  }else{
    $programaCheck = true;
  }
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
            <a class="nav-link js-scroll-trigger nav-red" href="#">Ranking</a>
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
    <div class="ranking-container">
      <form class="" action="ranking.php" method="post">
        <div class="ranking-content">
          <div class="ranking-search">
            <div class="ranking-title">
              <h2>Tabla de clasificación</h2>
            </div>
            <div class="form-group search">
              <select class="form-control search-select" name="liga-select" id="liga-select">
                <option hidden selected>Seleccione un club</option>
                <?php
                 $ligas = $userClass->getLigas();
                 foreach ($ligas as $row) {
                    $liga_nombre = $row['liga_nombre'];
                    echo"<option value='$liga_nombre'>$liga_nombre</option>";
                  }
                  ?>
              </select>
              <select class="form-control search-select" name="programa-select" id="programa-select">
                <option hidden selected>Seleccione un programa</option>
                <option>Administracion de Empresas</option>
                <option>Administracion de Empresas Turisticas y Hoteleras</option>
                <option>Administracion Maritima y Fluvial</option>
                <option>Arquitectura</option>
                <option>Ciencias Politicas</option>
                <option>Comunicacion Social - Periodismo</option>
                <option>Comunicacions Audiovisual(Antes Direccion y Produccion de Radio y Television)</option>
                <option>Contaduria Publica</option>
                <option>Deporte y Cultura Fisica</option>
                <option>Derecho</option>
                <option>Diseño de Espacios</option>
                <option>Diseño de Modas</option>
                <option>Diseño Grafico</option>
                <option>Ingenieria de Sistemas</option>
                <option>Ingenieria Electronica y Telecomunicaciones</option>
                <option>Ingenieria Industrial</option>
                <option>Ingenieria Mecanica</option>
                <option>Ingenieria Mecatronica</option>
                <option>Negocios y Finanzas Internacionales</option>
                <option>Psicologia</option>
                <option>Tecnica Profesional en Operaciones Portuarias</option>
                <option>Tecnologia en Gestion Portuaria</option>
              </select>
            </div>
            <div class="content-btn-ranking-search">
              <button type="submit" class="btn btn-default btn-primary">Buscar</button>
            </div>
          </div>
          <div class="ranking-table">
            <div class="table-responsive content-ranking-table">
              <table class="table ranking-table">
                <tr>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Club</th>
                  <th>Tag / Nickname</th>
                  <th>Nivel / Rango</th>
                  <th>Programa</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if ($ligaCheck==false && $programaCheck==true) {
                      $uid=$userClass->reportProgramaSecond($programa);
                      print "$uid";
                  }
                  if ($ligaCheck==true && $programaCheck==false) {
                      $uid=$userClass->reportLigaSecond($liga);
                      print "$uid";
                  }
                  if ($ligaCheck==true && $programaCheck==true) {
                      $uid=$userClass->reportLigaProgramaSecond($liga,$programa);
                      print "$uid";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </form>
    </div>
  </header>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="../assets/js/creative.min.js"></script>
</body>
</html>

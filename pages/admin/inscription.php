<?php
session_start();
include '../config.php';
include '../functions.php';
$autorizado = "";
//validamos si la variable global $_SESSION está en true o false
if (isset($_SESSION['autorizado'])) {
  $var_session = $_SESSION['autorizado'];
  if ($var_session == true) {
    $email = $_SESSION['email'];
  }
}
$autorizado = $_SESSION['autorizado'];
$userClass = new userClass();
$msg = "";
//Si está en false no tendrá acceso a la página y será redireccionado a login.php
if ($autorizado == false) {
    echo "No tienes autorización";
    echo '<meta http-equiv="refresh" content="1; url=../login.php">';
    die();
} else {
    $email = $_SESSION['email'];
}
$option = isset($_POST['liga']) ? $_POST['liga'] : false;
$tag = isset($_POST['user-name']) ? $_POST['user-name']: false;
$programa = isset($_POST['programa-select']) ? $_POST['programa-select']: false;
if ($option) {
  $selected_liga = $option;
  $uid = $userClass->inscripcionLiga($email, $selected_liga, $tag, $programa);
  if ($uid == true) {
    $msg = "Inscripción realizada";
  }else{
    $msg = "Error en la inscripción, o ya te encuentras inscrito en esta liga, recuerda que sólo puedes estar inscrito en una liga al mismo tiempo.
    Si cometiste un error en la inscripción de los datos por favor comunicate con los organizadores de E-Sports UAC en AYUDA";
  }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin E-Sports UAC</title>
  <link rel="icon" type="image/png" href="imagenes/logo.png" sizes="32x32">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/admin.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <!--<ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>-->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <?php
    include('aside.php');
   ?>

  <!-- /.Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper inscription-main">
    <!-- Main content -->
      <div class="inscription-container">
          <div class="inscription-search">
            <div class="inscription-title">
              <h2>Inscribete a una liga</h2>
            </div>
            <div class="form-group inscription">
              <form action="inscription.php" method="post">
                <select class="form-control career-select" name="programa-select" id="programa-select" required>
                  <option hidden selected value="">Seleccione un programa</option>
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
                <select class="form-control inscription-select" name="liga" id="liga" required>
                  <option hidden selected value="">Seleccione una liga</option>
                  <?php
                   $ligas = $userClass->getLigas();
                   foreach ($ligas as $row) {
                      $liga_nombre = $row['liga_nombre'];
                      echo"<option value='$liga_nombre'>$liga_nombre</option>";
                    }
                    ?>
                </select>
                <div class="form-group">
                  <input type="text" class="form-control" id="user-name" placeholder="Tag / Nickname" name="user-name" required>
                </div>
                <div class="msg-terms-and-conditions">
                  Te recomendamos leer detenidamente los términos y condiciones, son diferentes para cada liga y cualquier incumplimiento a
                  nuestras normas de suplantación o robo de identidad llevará a sanciones proporcionales.
                </div>
                <div class="form-check form-group container-terms-and-conditions">
                  <input class="form-check-input check-terms-and-conditions" type="checkbox" id="terms-and-conditions" required>
                  <label class="form-check-label" data-toggle="modal" data-target="#exampleModalCenter" for="terms-and-conditions">
                    Acepto <span class="terms-and-conditions">términos y condiciones </span>
                  </label>
              </div>
                <div class="btn-content-inscription">
                  <button type="submit" class="btn btn-default btn-inscription">Inscribir</button>
                </div>
                <div class="msg-error">
                  <?php echo $msg; ?>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Términos y condiciones E-Sports UAC</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modal-incription">
                        <p class="lol">
                          <span>LEAGUE OF LEGENDS</span>
                          - Riot Games le ha concedido a la Universidad Autonoma del Caribe el uso de sus aplicaciones para la región LAN (Latin America North) por lo cual te pedimos encarecidamente:
                          1. Usar tu nombre de invocador propio, cualquier tipo de personificación, tercerización de cuentas o falsificación de identidad, que pueda ser verificada será sancionada según lo expuesto por las leyes
                          más los términos y condiciones propios de Riot Games, que pueden llevar a suspensiones de la cuenta e incluso bloqueo permanente.
                          2. Sólo puedes inscribirte con una cuenta, si posees más de una cuenta de League of Legends te recomendamos que elijas bien ya que revertir este paso sólo alentara tu proceso.
                        </p>
                        <p class="valorant">
                          <span>VALORANT</span>
                          - Riot Games le ha concedido a la Universidad Autonoma del Caribe el uso de sus aplicaciones para la región LAN (Latin America North) por lo cual te pedimos encarecidamente:
                          1. Usar tu nombre de invocador propio, cualquier tipo de personificación, tercerización de cuentas o falsificación de identidad, que pueda ser verificada será sancionada según lo expuesto por las leyes
                          más los términos y condiciones propios de Riot Games, que pueden llevar a suspensiones de la cuenta e incluso bloqueo permanente.
                          2. Sólo puedes inscribirte con una cuenta, si posees más de una cuenta de Valorant te recomendamos que elijas bien ya que revertir este paso sólo alentara tu proceso.
                        </p>
                        <p class="smash">
                          <span>SUPER SMASH BROS. ULTIMATE</span>
                          - La comunidad de Super Smash Bros. Ultimate de Colombia y más respectivamente de Barranquilla, apoyan el crecimiento de la comunidad de Super Smash Bros. Ultimate, por lo cual te pedimos encarecidamente:
                          1. Usar tu tag/nickname propio, cualquier tipo de personificación, tercerización de cuentas o falsificación de identidad, que pueda ser verificada será sancionada por la comunidad, por lo cual puede llevar a
                          evitar tu participación en los torneos locales y nacionales.
                          2. Si perteneces a un grupo, equipo o clan de Super Smash Bros. te pedimos que agregues las respectivas siglas antes de tu nombre, ejemplo: Team Solo Mid representa a sus integrantes por las siglas TSM. (TSM Tweek, TSM Doublelift, etc)
                        </p>
                        <p class="default">
                          Seleccione una liga.
                        </p>
                      </div>
                      <div class="modal-footer options-popup" >
                        <button type="button" class="btn btn-default btn-accept" data-dismiss="modal">Aceptar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/admin.js"></script>
</body>
</html>

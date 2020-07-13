<?php
if(!isset($_SESSION))
    {
        session_start();
    }
include '../config.php';
include '../functions.php';
$userClass = new userClass();
//validamos si la variable global $_SESSION está en true o false
$autorizado = $_SESSION['autorizado'];
$email = $_SESSION['email'];
//Si está en false no tendrá acceso a la página y será redireccionado a login.php
if ($autorizado == false) {
  echo "No tienes autorización";
  echo '<meta http-equiv="refresh" content="0; url=login.php">';
  die();
}
$thisLiga = $userClass->getLigaUser($email);
if ($thisLiga == "" || $thisLiga == NULL || $thisLiga == " ") {
  $thisLiga = "NINGUNA";
}
$msg = "";
$msg2 = "";

if (isset($_POST['nueva_contraseña']) && isset($_POST['repite_contraseña']) && isset($_POST['vieja_password'])) {
  $password = strip_tags($_POST['nueva_contraseña']);
  $repite_contraseña = strip_tags($_POST['repite_contraseña']);
  $vieja_password = strip_tags($_POST['vieja_password']);
  $uid2 = $userClass->checkPassword($email,$vieja_password);
  if ($uid2==true) {
    if (strcmp($password, $repite_contraseña) !==0) {
      $msg2.="Las claves no coinciden <br>";
    }elseif (strlen($password) < 8) {
      $msg2.="La contraseña debe ser mayor a 8 carácteres <br>";
    }else{
      if (strcmp($vieja_password, $repite_contraseña) ==0 || strcmp($vieja_password, $password) ==0) {
        $msg2.="Se desea cambiar la contraseña, debe actualizar a una contraseña diferente";
      }else{
        $uid = $userClass->changePassword($email,$password);
        if ($uid == true) {
          $msg2 = "La clave ha sido cambiada exitosamente";
        }else{
          $msg2 = "Error en el cambio de clave";
        }
      }
    }
  }else{
    $msg2 = "Contraseña actual errada";
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
  <link rel="icon" type="image/png" href="dist/img/logo-uac.png">

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
  <div class="content-wrapper configuration-main">
    <!-- Main content -->
    <div class="configuration-container">
        <div class="configuration-content-password">
          <div class="configuration-title">
            <h2>Cambiar contraseña</h2>
          </div>
          <div class="form-group configuration">
            <form role="form" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Ingresar contraseña actual</label>
                  <input name="vieja_password" type="password" class="form-control" id="vieja_password" placeholder="Contraseña actual">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Ingresar nueva contraseña</label>
                  <input name="nueva_contraseña" type="password" class="form-control" id="nueva_contraseña" placeholder="Nueva contraseña">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirmar nueva contraseña</label>
                  <input name="repite_contraseña" type="password" class="form-control" id="repite_contraseña" placeholder="Repetir nueva contraseña">
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary btn-change">Cambiar</button>
                  <div class="msg-error">
                    <?php if ($msg2!="") {
                      echo $msg2;
                    } ?>
                  </div>
                </div>
            </form>
          </div>
        </div>
        <div class="configuration-content-ligue">
            <div class="configuration-title">
              <h2>Detalles de la liga</h2>
            </div>
            <div class="registered-league">
              <span>Actualmente te encuentras inscrito en la liga de:</span>
              <p class="current-league"><?php echo $thisLiga; ?></p>
              <div class="img-current-ligue">

              </div>
              <p class="change-ligue">Si deseas cambiar de liga dirigete a Ayuda <i class="nav-icon fas fa-info"></i></p>
            </div>
        </div>
    </div>
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

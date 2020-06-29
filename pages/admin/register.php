<?php
$msg ="";
$email = "";
$password ="";
$repite_password ="";


if ( isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repite_password']) && isset($_POST['de_acuerdo'])) {
  if ($_POST['email'] == "") {
    $msg.="Debe ingresar un correo <br>";
  }

  if ($_POST['password'] == "") {
    $msg.= "Debe ingresar una contraseña <br>";
  }
  if ($_POST['repite_password'] == "") {
    $msg.= "Debe repetir la clave <br>";
  }

  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);
  $repite_password = strip_tags($_POST['repite_password']);

  if (strcmp($password, $repite_password) !==0) {
    $msg.="Las claves no coinciden <br>";
  }elseif (strlen($password) < 8) {
    $msg.="La contraseña debe ser mayor a 8 carácteres <br>";
  }else{
    $mysqli = mysqli_connect("localhost","root","","esportsuac");
    if (!$mysqli) {
      echo "Error en la conexión";
      die();
    }
    //Hasta acá todo va bien
    $ip = $_SERVER['REMOTE_ADDR'];
    $resultado = $mysqli->query("SELECT * FROM `usuarios`  WHERE `usuarios_email` = '".$email."'");
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

    $cantidad = count($usuarios);

    if ($cantidad == 0) {
      $password = sha1($password);
      $mysqli->query("INSERT INTO `usuarios` ( `usuarios_email`, `usuarios_password`, `usuarios_ip`)
                      VALUES ('".$email."','".$password."','".$ip."');");
      $msg.="Usuario creado correctamente, <br> ingrese haciendo <a href='login.php'>click aquí</a>";
    }else {
      $msg.="Usuario ya existe";
    }
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registra tu cuenta</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>PHP</b>Tube
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registo de nuevo usuario</p>

      <form action="register.php" method="post">
        <div class="input-group mb-3">
          <input name = "email" type="email" class="form-control" placeholder="Correo" value = <?php echo $email ?>>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name = "password" type="password" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="repite_password" type="password" class="form-control" placeholder="Confirmar contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input name="de_acuerdo" type="checkbox" id="agreeTerms" required>
              <label for="agreeTerms">
               Acepto <a href="https://www.google.com/">términos y condiciones</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
        <div style="color:red">
            <?php echo $msg; ?>
        </div>
      </form>
      <a href="login.php" class="text-center">Ya tengo una cuenta</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

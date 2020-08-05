<?php
include '../includes/head.php';
include 'config.php';
include 'functions.php';
$userClass = new userClass();
$msg ="";
$email = "";
$password ="";
$repite_password ="";
$nombre = "";
$apellido = "";
$celular = "";
$identificacion = "";
if (isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['pwd-confirm']) && isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['id-number'])) {
    if ($_POST['email'] == "") {
        $msgEmail.="La dirección de correo electrónico es obligatoria <br>";
    }
    if ($_POST['pwd'] == "") {
        $msgPWD.= "Se necesita una contraseña";
    }
    if ($_POST['pwd-confirm'] == "") {
        $msgRPWD.= "Debe repetir la contraseña";
    }
    if ($_POST['name'] == "") {
        $msgNombre.= "Debe ingresar su nombre";
    }
    if ($_POST['lastname'] == "") {
        $msgApellidos.= "Debe ingresar sus apellidos";
    }
    if ($_POST['id-number'] == "") {
        $msgID.= "Debe ingresar número de identifiación";
    }
    $nombre = strip_tags($_POST['name']);
    $apellido = strip_tags($_POST['lastname']);
    $tipo_id = $_POST['id-type'];
    $identificacion = strip_tags($_POST['id-number']);
    $email = strip_tags($_POST['email']);
    $codigo = strip_tags($_POST['codigo-est']);
    $password = strip_tags($_POST['pwd']);
    $repite_password = strip_tags($_POST['pwd-confirm']);
    $firstEmailCheck = "@uac.edu.co";
    $secondEmailCheck = "@uautonoma.edu.co";
      if (strcmp($password, $repite_password) !==0) {
          $msg.="Las contraseñas no coinciden.";
      } elseif (strlen($password) < 8) {
          $msg.="La contraseña debe ser mayor a 8 carácteres.";
      } elseif (strpos($email,$firstEmailCheck)!==false || strpos($email,$secondEmailCheck)!==false)  {
          $uid=$userClass->userRegistration($nombre, $apellido, $tipo_id, $identificacion, $email, $password, $codigo);
          if ($uid) {
              $uid2=$userClass->sendEmail($email);
              $_SESSION['correo'] = $email;
              $msg.="Usuario creado correctamente, redirigiendo";
              echo '<meta http-equiv="refresh" content="2; url=code.php">';
          } else {
              $msg.="Ese correo electrónico ya está en uso.";
          }
      }else{
        $msg.="Sólo puedes inscribirte con correos institucionales tipo @uac.edu.co / @uautonoma.edu.co";
      }
    }

 ?>
  <body>
    <div class="container-primary">
        <div class="content-secondary">
          <h2 class="text-center">Registrarse</h2>
          <div class="msg-error">
              <?php echo $msg; ?>
          </div>
          <form action="signin.php" method="post">
            <div class="form-signin-content">
              <div class="form-group">
                <p class="font-primary font-weight-bold mg-0">Nombres</p>
                <input type="text" class="input-primary" id="name" placeholder="Ingrese nombres" name="name" maxlength="50" required >
              </div>
              <div class="form-group">
                <p class="font-primary font-weight-bold mg-0">Apellidos</p>
                <input type="text" class="input-primary" id="lastname" placeholder="Ingrese apellidos" name="lastname" maxlength="50" required>
              </div>
              <div class="form-group">
                <p class="font-primary font-weight-bold mg-0">Tipo de indentifiación</p>
                <select class="input-primary" id="id-type" name="id-type" required>
                  <option hidden selected value="">Seleccione un tipo de indentifiación</option>
                  <option value="cedula">Cédula</option>
                  <option value="ti">Tajeta de identidad</option>
                </select>
              </div>
              <div class="form-group input-id-number">
                <p class="font-primary font-weight-bold mg-0">Número de identificación</p>
                <input type="text" class="input-primary" id="id-number" placeholder="Ingrese número de identificación" name="id-number" required>
              </div>
              <div class="form-group">
                <p class="font-primary font-weight-bold mg-0">Tipo de usuario</p>
                <select class="input-primary" id="type-user" name="type-user" required>
                  <option hidden selected value="">Seleccione un tipo de usuario</option>
                  <option value="estudiante">Estudiante</option>
                  <option value="egresado">Egresado</option>
                  <option value="administrativo">Administrativo</option>
                </select>
              </div>
              <div class="form-group input-id-number">
                <p class="font-primary font-weight-bold mg-0">Código de usuario</p>
                <input type="text" class="input-primary" id="codigo-est" placeholder="Ingrese código de usuario" name="codigo-est" required>
              </div>
              <div class="form-group input-email">
                <p class="font-primary font-weight-bold mg-0">Correo electrónico</p>
                <p class="email-info">Recuerda registrarte con tu correo @uac.edu.co ó @uautonoma.edu.co</p>
                <input type="email" class="input-primary" id="email" placeholder="Ingrese correo electrónico" name="email" maxlength="50" required>
              </div>
              <div class="form-group">
                <p class="font-primary font-weight-bold mg-0">Contraseña</p>
                <input type="password" class="input-primary" id="pwd" placeholder="Ingrese contraseña" name="pwd" maxlength="20" required>
              </div>
              <div class="form-group input-pwd-confirm">
                <p class="font-primary font-weight-bold mg-0">Confirmar contraseña</p>
                <input type="password" class="input-primary" id="pwd-confirm" placeholder="Ingrese confirmar contraseña" name="pwd-confirm" maxlength="20" required>
              </div>
              <div class="content-btn-form-sign">
                <button type="submit" class="btn btn-default btn-primary">Registrar</button>
              </div>
            </div>
            <div class="text-center">
              <span class="font-secondary">¿Ya tienes cuenta?</span>
              <a href="login.php" class="link">Inicia sesión ahora</a>
            </div>

          </form>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>

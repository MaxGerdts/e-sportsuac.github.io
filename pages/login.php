<?php
include '../includes/head.php';
include 'config.php';
include 'functions.php';
$userClass = new userClass();
$_SESSION['autorizado']=false;
$autorizado = false;
$email="";
$password="";
$msg="";
if (isset($_POST['email']) && isset($_POST['pwd'])) {
    if ($_POST['email'] =="") {
        $msg.="Ingrese correo <br>";
    } elseif ($_POST['pwd'] == "") {
        $msg.="Ingrese contraseña <br>";
    } else {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['pwd']);
        $uid=$userClass->userLogin($email, $password);
        if ($uid) {
            $hoy = date("Y-m-d H:i:s");
          /*  $sql_nombre = "SELECT nombre usuarios_nombre FROM esportsuac_usuarios WHERE usuarios_email = $email";
            $sql_apellidos = "SELECT nombre usuarios_apellidos FROM esportsuac_usuarios WHERE usuarios_email = $email";
            $sql_nombre = odbc_exec($sql_nombre);
            $sql_apellidos = odbc_exec($sql_apellidos);
            $sql_nombre = odbc_fetch_all($sql_nombre);
            $sql_apellidos = odbc_fetch_all($sql_apellidos);*/
            if(!isset($_SESSION))
              {
                session_start();
              }
            $uid2=$userClass->checkUser($email);
            if ($uid2) {
              //$mysqli->query("UPDATE `usuarios` SET `usuarios_ultimo_login`= '".$hoy."' WHERE `usuarios_email` = '".$email."'");
              $msg ="Bienvenido";
              $uid3=$userClass->userType($email);
              //Hasta este punto el usuario ha podido ingresar, entonces está autorizado
              $_SESSION['autorizado'] = true;
              $username = $userClass->selectNombre($email);
              $_SESSION['user'] = $username;
              $_SESSION['email'] = $email;
              $_SESSION['tipo'] = $uid3;
              echo '<meta http-equiv="refresh" content="1; url=../index.php">';
            }else{
              $_SESSION['email'] = $email;
              $msg.='Usuario aun no verificado,has echo <a href="code.php">has click aquí ahora</a> para verificar tu usuario con el código que enviamos a tu correo';
            }
        } else {
            $msg.="Nombre de usuario o contraseña incorrecta";
            $_SESSION['autorizado'] = false;
        }
    }
}

 ?>
  <body>
    <div class="form-container">
      <div id="login-content">
        <div class="container form-login">
          <h2 class="title-login">Iniciar sesión</h2>
          <div class="msg-error">
            <?php echo $msg; ?>
          </div>
          <form action="login.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Correo electrónico" name="email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="pwd" placeholder="Contraseña" name="pwd" required>
            </div>
            <div class="content-btn-form-login">
              <button type="submit" class="btn btn-default btn-form-login">Iniciar sesión</button>
            </div>
            <div class="forgot-password">
              <a href="recover-password.php">¿Olvidaste la contraseña?</a>
            </div>
            <div class="form-login-sign-in">
              <label>¿No tienes cuenta?</label>
              <a href="signin.php">Registraste ahora</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>

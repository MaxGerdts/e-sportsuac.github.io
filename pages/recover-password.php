<?php
include '../includes/head.php';
include 'config.php';
include 'functions.php';
$userClass = new userClass();
$_SESSION['autorizado']=false;
$autorizado = false;
$email="";
$msg="";
if (isset($_POST['email'])) {
    if ($_POST['email'] =="") {
        $msg.="Ingrese correo <br>";
    }else{
      $email = $_POST['email'];
      $uid1=$userClass->checkEmail($email);
      if ($uid1) {
        $randomPassword=$userClass->randomPassword();
        $uid2=$userClass->changeToRandomPassword($randomPassword, $email);
        $uid3=$userClass->sendEmailRandomPassword($email,$randomPassword);
        $email = "";
        $msg="Correo enviado correctamente, reivsa tu bandeja de entrada y sigue los pasos";
      }else{
        $msg.="Correo incorrecto o correo aun no activado, verifique la dirección de e-mail";
      }
    }
}

 ?>
  <body>
    <div class="form-container">
      <div id="recover-password-content">
        <div class="container form-recover-password">
          <h2 class="title-recover-password">Recuperar contraseña</h2>
          <div class="msg-error">
            <?php echo $msg; ?>
          </div>
          <div class="">
            <p>Ingresa tu cuenta de correo electrónico</p>
          </div>
          <form action="recover-password.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Correo electrónico" name="email" required>
            </div>
            <div class="content-btn-form-recover-password">
              <button type="submit" class="btn btn-default btn-form-recover-password">Enviar</button>
            </div>
            <div class="recover-password">
              <a href="login.php">Volver al inicio de sesión</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>

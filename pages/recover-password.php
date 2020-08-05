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
        $msg="Correo enviado correctamente, revisa tu bandeja de entrada y sigue los pasos.";
      }else{
        $msg.="Correo incorrecto o correo aun no activado, verifique la dirección de e-mail.";
      }
    }
}

 ?>
  <body>
    <div class="container-primary">
        <div class="content-primary">
          <h2 class="text-center">Recuperar contraseña</h2>
          <div class="msg-error">
            <?php echo $msg; ?>
          </div>
          <form action="recover-password.php" method="post">
            <div class="form-group">
              <p class="font-primary font-weight-bold mg-0">Correo electrónico</p>
              <input type="email" class="input-primary" id="email" placeholder="Ingrese correo electrónico" name="email" required>
              <button type="submit" class="btn btn-default btn-primary">Enviar</button>
            </div>
            <div class="text-center">
              <a href="login.php" class="link">Volver al inicio de sesión</a>
            </div>
          </form>
        </div>
    </div>
</body>
</html>

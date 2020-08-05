<?php
session_start();
include '../includes/head.php';
include 'config.php';
include 'functions.php';
$userClass = new userClass();
if (isset($_SESSION['correo'])) {
  $email = $_SESSION['correo'];
}elseif (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}
$correo = $_SESSION['correo'];
$msg = "";

if (isset($_POST['code'])) {
  $code = $_POST['code'];
  $uid = $userClass->validateCode($correo,$code);
  if ($uid) {
    $msg ="Código confirmado";
    echo '<meta http-equiv="refresh" content="2; url=login.php">';
  }else {
    $msg ="Código errado";
  }

}
 ?>
<body>
  <div class="container-primary">
      <div class="content-primary">
        <h2 class="text-center">Confirmar correo electrónico</h2>
        <div class="info-code">
          <span>Tu cuenta está registrada en nuestra plataforma, para finalizar se ha enviado un código de confirmación a tu correo electrónico.</span>
          <p class="not-wanted">Es posible que debas revisar la sección de correos no deseados.</p>
        </div>
        <form action="code.php" method="post">
          <div class="form-group">
            <input type="text" class="input-primary" id="code" placeholder="Ingrese código" name="code" required>
            <button type="submit" class="btn btn-default btn-primary">Confirmar</button>
          </div>
          <div class="msg-error">
            <?php echo $msg; ?>
          </div>
        </form>
      </div>
  </div>
</body>
</html>

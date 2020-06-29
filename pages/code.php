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
  <div class="form-container">
    <div id="login-content">
      <div class="container form-login">
        <h2 class="title-login">Digita tu código</h2>
        <form action="code.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" id="code" placeholder="Código" name="code" required>
          </div>
          <div class="content-btn-form-login">
            <button type="submit" class="btn btn-default btn-form-login">Enviar</button>
          </div>
          <div class="msg-error">
            <?php echo $msg; ?>
          </div>
          <div class="">
            Se ha enviado un correo con un código de confirmación,
            Si no has recibido nada has click aquí para reenviar el codigo
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
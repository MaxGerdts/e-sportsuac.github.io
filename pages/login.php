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
              $uid3=$userClass->sendEmail($email);
              $_SESSION['email'] = $email;
              $msg.='Tu cuenta no ha sido verificada, te hemos enviando un código de confirmación a tu correo electrónico. <a href="code.php">Has click aquí</a> para ingresar el código.';
            }
        } else {
            $msg.="Nombre de usuario o contraseña incorrecta.";
            $_SESSION['autorizado'] = false;
        }
    }
}

 ?>
 <body>
   <div class="container-primary">
       <div class="content-primary">
         <h2 class="text-center">Iniciar sesión</h2>
         <div class="msg-error">
           <?php echo $msg; ?>
         </div>
         <form action="login.php" method="post">
           <div class="form-group">
             <p class="font-primary font-weight-bold mg-0">Correo electrónico</p>
             <input type="email" class="input-primary" id="email" placeholder="Ingrese correo electrónico" name="email" required>
             <p class="font-primary font-weight-bold mg-0">Contraseña</p>
             <input type="password" class="input-primary" id="pwd" placeholder="Ingrese contraseña" name="pwd" required>
             <button type="submit" class="btn btn-default btn-primary">Iniciar sesión</button>
           </div>
           <a href="recover-password.php" class="d-block link text-center">¿Olvidaste la contraseña?</a>
           <div class="text-center">
             <span class="font-secondary">¿No tienes cuenta?</span>
             <a href="signin.php" class="link">Registraste ahora</a>
           </div>
         </form>
     </div>
   </div>
</body>
</html>

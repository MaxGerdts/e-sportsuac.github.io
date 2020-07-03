<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../config.php';
include '../functions.php';
$userClass = new userClass();
//validamos si la variable global $_SESSION está en true o false
$autorizado = $_SESSION['autorizado'];
$email = $_SESSION['email'];
$msg="";
//Si está en false no tendrá acceso a la página y será redireccionado a login.php
if ($autorizado == false) {
    echo "No tienes autorización";
    echo '<meta http-equiv="refresh" content="0; url=login.php">';
    die();
}

if (isset($_POST['topic']) && isset($_POST['body'])) {
  $topic = $_POST['topic'];
  $body = $_POST['body'];
    if (isset($_POST['liga'])) {
      $ligaF = $_POST['liga'];
      if ($ligaF != "" && $ligaF != "Seleccione una liga") {
        $uid4 = $userClass->getCorreos($ligaF);
        if (isset($_POST['file-7'])) {
          $path = $_POST['file-7'];
          foreach ($uid4 as $row) {
              $uid5 = $userClass->sendEmailAttach($row['usuarios_email'],$topic,$body,$path);
          }
          if ($uid5 == true) {
            echo '<script type="text/javascript">alert("Mensaje enviado correctamente");</script>';
            header("Location: inscription.php");
          }else{
            $msg = "Error en la conexión";
          }
        }else{
          foreach ($uid4 as $row) {
              $uid5 = $userClass->sendEmailNone($row['usuarios_email'],$topic,$body);
          }
          if ($uid5 == true) {
            echo '<script type="text/javascript">alert("Mensaje enviado correctamente");</script>';
            header("Location: inscription.php");
          }else{
            $msg = "Error en la conexión";
          }
        }
      }
      if (isset($_POST['especific-email'])) {
        $specific = $_POST['especific-email'];
        if ($specific != "") {
          $errorCode = $_FILES['file-7']['error'];
          if ($errorCode != 0) {
            $checkDelimiter = strpos($specific,";");
            if ($checkDelimiter === true) {
              $specific = explode(";",$explode);
              foreach ($specific as $sp) {
                $uid5 = $userClass->sendEmailNone($sp,$topic,$body);
              }
            }else{
                $uid5 = $userClass->sendEmailNone($specific,$topic,$body);
            }
              if ($uid5 == true) {
                echo '<script type="text/javascript">alert("Mensaje enviado correctamente");</script>';
                header("Location: inscription.php");
              }else{
                $msg = "Error en la conexión";
              }
            }else{
              $path = $_FILES['file-7']['name'];
              move_uploaded_file($_FILES['file-7']['tmp_name'],$path);
              $checkDelimiter = strpos($specific,";");
              if ($checkDelimiter === true) {
                $specific = explode(";",$explode);
                foreach ($specific as $sp) {
                  $uid5 = $userClass->sendEmailNone($sp,$topic,$body);
                }
              }else{
                  $uid5 = $userClass->sendEmailNone($specific,$topic,$body);
              }
                if ($uid5 == true) {
                  echo '<script type="text/javascript">alert("Mensaje enviado correctamente");</script>';
                  header("Location: inscription.php");
                }else{
                  $msg = "Error en la conexión";
                }
          }
        }
      }
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
  <form action="email.php" method="post" enctype="multipart/form-data">
  <div class="content-wrapper email-main">
    <!-- Main content -->
      <div class="email-container">
        <div class="email-content">
            <div class="head-email">
              <div class="affair-content">
                <span>Asunto</span>
                <input type="text" class="form-control" id="topic" name="topic" required>
              </div>
              <div class="all-content">
                <div class="all-ligue-content">
                  <span>Liga</span>
                  <select class="form-control inscription-select" name="liga" id="liga" >
                    <option hidden selected value="">Seleccione una liga</option>
                    <?php
                     $ligas = $userClass->getLigas();
                     foreach ($ligas as $row) {
                         $liga_nombre = $row['liga_nombre'];
                         echo"<option value='$liga_nombre'>$liga_nombre</option>";
                     }
                      ?>
                  </select>
                </div>
                <div class="all-ligue-content">
                  <span>Correo especifico</span>
                  <input type="text" class="form-control" id="all-especific-email" name="especific-email">
                </div>
              </div>
            </div>
            <div class="email-body">
              <textarea class="email" name="body" id="body" rows="10" required></textarea>
            </div>
            <div class="email-buttons">
              <div class="content-btn-email-file">
                <input type="file" name="file-7" id="file-quote" class="inputfile inputfile-quote" accept=".doc, .docx, .pdf, .xls, .jpg, jpeg, .gif, .png" />
                  <label for="file-quote">
                  <span class="file-span"></span>
                  <strong>
                  Subir archivo <?php echo $msg; ?>
                  </strong>
                  </label>
              </div>
              <div class="content-btn-email-send">
                <button type="submit" class="btn btn-default btn-email-send">Enviar</button>
              </div>
            </div>
          </div>
      </div>
  </div>
    </form>
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

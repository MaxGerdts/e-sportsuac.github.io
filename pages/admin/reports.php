<?php
if(!isset($_SESSION))
    {
        session_start();
    }
include '../config.php';
include '../functions.php';

$userClass = new userClass();
$ligaCheck ="";
$programaCheck="";
$codigoCheck="";

//validamos si la variable global $_SESSION está en true o false
$autorizado = $_SESSION['autorizado'];
$email = $_SESSION['email'];
//Si está en false no tendrá acceso a la página y será redireccionado a login.php
if ($autorizado == false) {
  echo "No tienes autorización";
  echo '<meta http-equiv="refresh" content="0; url=login.php">';
  die();
}
if (isset($_POST['liga-select'])) {
  $liga = $_POST['liga-select'];
  if ($liga=="") {
    $ligaCheck = false;
  }else{
    $ligaCheck = true;
  }
}
if (isset($_POST['programa-select'])) {
  $programa = $_POST['programa-select'];
  if ($programa=="") {
    $programaCheck = false;
  }else{
    $programaCheck = true;
  }
}
if (isset($_POST['codigo-est'])) {
  $codigo = $_POST['codigo-est'];
  if ($codigo=="") {
    $codigoCheck = false;
  }else{
    $codigoCheck = true;
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" language ="Javascript1.2">
function exportTableToExcel(tableID, filename = ''){
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  var tableSelect = document.getElementById(tableID);
  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

  // Specify file name
  filename = filename?filename+'.xls':'excel_data.xls';

  // Create download link element
  downloadLink = document.createElement("a");

  document.body.appendChild(downloadLink);

  if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['\ufeff', tableHTML], {
          type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
  }else{
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

      // Setting the file name
      downloadLink.download = filename;

      //triggering the function
      downloadLink.click();
  }
}
</script>
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
  <div class="content-wrapper reports-main">
    <!-- Main content -->
      <div class="reports-container">
          <div class="reports-content">
            <div class="reports-title">
              <h2>Reportes</h2>
            </div>
            <form class="" action="reports.php" method="post">
              <div class="form-group">
                <select class="form-control inscription-select" name="liga-select" id="liga-select">
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
              <div class="form-group">
                <select class="form-control inscription-select" name="programa-select" id="programa-select">
                  <option hidden selected value="">Seleccione un programa</option>
                  <option>Administracion de Empresas</option>
                  <option>Administracion de Empresas Turisticas y Hoteleras</option>
                  <option>Administracion Maritima y Fluvial</option>
                  <option>Arquitectura</option>
                  <option>Ciencias Politicas</option>
                  <option>Comunicacion Social - Periodismo</option>
                  <option>Comunicacions Audiovisual(Antes Direccion y Produccion de Radio y Television)</option>
                  <option>Contaduria Publica</option>
                  <option>Deporte y Cultura Fisica</option>
                  <option>Derecho</option>
                  <option>Diseño de Espacios</option>
                  <option>Diseño de Modas</option>
                  <option>Diseño Grafico</option>
                  <option>Ingenieria de Sistemas</option>
                  <option>Ingenieria Electronica y Telecomunicaciones</option>
                  <option>Ingenieria Industrial</option>
                  <option>Ingenieria Mecanica</option>
                  <option>Ingenieria Mecatronica</option>
                  <option>Negocios y Finanzas Internacionales</option>
                  <option>Psicologia</option>
                  <option>Tecnica Profesional en Operaciones Portuarias</option>
                  <option>Tecnologia en Gestion Portuaria</option>
                  </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="type-user" name="type-user" required>
                  <option hidden selected value="">Seleccione un tipo de usuario</option>
                  <option value="estudiante">Estudiante</option>
                  <option value="egresado">Egresado</option>
                  <option value="administrativo">Administrativo</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="codigo-est" placeholder="Código" name="codigo-est">
              </div>
              <div class="content-btn-reports">
                <div class="content-btn-reports-search">
                  <button type="submit" class="btn  btn-reports-search">Buscar</button>
                </div>
                <div class="content-btn-reports-generate">
                  <button name="exportToExcel" id="exportToExcel" class="exportToExcel" onclick="exportTableToExcel('table2excel','Reporte UAC-Esports')">Generar</button>
                </div>
              </div>
            </form>
          </div>
          <div class="reports-table-container">
            <div class="table-responsive content-reports-table">
              <table class="table reports-table" name ="table2excel" id="table2excel">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Tipo de indentificación</th>
                    <th>No. de indentificación</th>
                    <th>Código</th>
                    <th>Correo</th>
                    <th>Liga</th>
                    <th>Tag / Nickname</th>
                    <th>Programa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($ligaCheck==false && $programaCheck==false && $codigoCheck==false) {
                      $uid=$userClass->reportAll();
                      print "$uid";
                  }
                  if ($ligaCheck==false && $programaCheck==false && $codigoCheck==true) {
                      $uid=$userClass->reportCodigo($codigo);
                      print "$uid";
                    }
                    if ($ligaCheck==false && $programaCheck==true && $codigoCheck==false) {
                        $uid=$userClass->reportPrograma($programa);
                        print "$uid";
                    }
                    if ($ligaCheck==true && $programaCheck==false && $codigoCheck==false) {
                        $uid=$userClass->reportLiga($liga);
                        print "$uid";
                    }
                    if ($ligaCheck==true && $programaCheck==true && $codigoCheck==false) {
                        $uid=$userClass->reportLigaPrograma($liga,$programa);
                        print "$uid";
                    }
                    if ($ligaCheck==true && $programaCheck==false && $codigoCheck==true) {
                        $uid=$userClass->reportLigaCodigo($liga, $codigo);
                        print "$uid";
                    }
                    if ($ligaCheck==false && $programaCheck==true && $codigoCheck==true) {
                        $uid=$userClass->reportProgramaCodigo($programa,$codigo);
                        print "$uid";
                    }
                    if ($ligaCheck==true && $programaCheck==true && $codigoCheck==true) {
                        $uid=$userClass->reportLigaPrograma($liga,$programa,$codigo);
                        print "$uid";
                    }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
      </div>
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

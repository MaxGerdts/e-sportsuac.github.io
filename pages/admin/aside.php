<?php
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['user'])) {
  $username = $_SESSION['user'];
}else{
  $username = "";
}
if (isset($_SESSION['tipo'])) {
  $var_check = $_SESSION['tipo'];
  if ($var_check == true) {
    $code ='       <li class="nav-item menu-open">
              <a href="reports.php" class="nav-link">
                <i class="nav-icon far fa-file-alt"></i>
                <p>
                  Reportes
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="email.php" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Correo
                </p>
              </a>
            </li>' ;
  }else{
    $code = '';
  }
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <div class="login-logo">
    <img src="dist/img/logo.png" alt="">
  </div>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <span class="email"><?php echo $username ?></span>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" id="nav-admin" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="header">
            <p>
              Menú
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="inscription.php" class="nav-link">
            <i class="nav-icon far fa-edit"></i>
            <p>
              Inscripción a una liga
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="configuration.php" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Configuración de cuenta
            </p>
          </a>
        </li>
<?php echo $code; ?>
        <li class="nav-item menu-open">
          <a href="help.php" class="nav-link">
            <i class="nav-icon fas fa-info"></i>
            <p>
              Ayuda
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="../logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-in-alt"></i>
            <p>
              Cerrar sesión
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

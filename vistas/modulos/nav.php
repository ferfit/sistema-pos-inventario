<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>

  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">

      <a  class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span>
          <?= $_SESSION['nombre'];?>
        </span>
      </a>

      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

        <li class="user-footer">
          <a class="btn btn-default btn-flat float-right  btn-block " href="cerrar-sesion">
            <i class="fa fa-fw fa-power-off"></i>
            Salir
          </a>
        </li>

      </ul>

    </li>
  </ul>
</nav>
<!-- /.navbar -->
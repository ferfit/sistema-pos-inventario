<?php
require_once('config.php');
session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Inventario</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./vistas/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $vistas; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $vistas; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $vistas; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= $vistas; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">


  <!-- jQuery -->
  <script src="<?= $vistas; ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= $vistas; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= $vistas; ?>/dist/js/adminlte.min.js"></script>
  <!-- Sweet Alert 2 -->
  <script src="<?= $vistas; ?>/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!--   <script src="./vistas/dist/js/demo.js"></script> -->

</head>

<body class="hold-transition sidebar-mini <?= $_SESSION['iniciarSesion'] == "ok"  ? '' : 'login-page'; ?>">

  <!-- Comprueba si el usuario esta logeado -->
  <?php
  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
  ?>

    <div class="wrapper">

      <!-- Incluye nav superior -->
      <?php include 'modulos/nav.php'; ?>

      <!-- Incluye barra lateral -->
      <?php include 'modulos/aside.php'; ?>

      <!-- Contenido -->
      <?php
      if (isset($_GET['ruta'])) {
        if (
          $_GET['ruta'] == "inicio" ||
          $_GET['ruta'] == "usuarios" ||
          $_GET['ruta'] == "categorias" ||
          $_GET['ruta'] == "productos" ||
          $_GET['ruta'] == "clientes" ||
          $_GET['ruta'] == "ventas" ||
          $_GET['ruta'] == "crear-venta" ||
          $_GET['ruta'] == "reportes" ||
          $_GET['ruta'] == "cerrar-sesion"
        ) {
          include 'modulos/' . $_GET['ruta'] . '.php';
        } else {
          include "modulos/404.php";
        }
      } else {
        include "modulos/inicio.php";
      }

      ?>

      <!-- Footer -->
      <?php include 'modulos/footer.php'; ?>


    </div>

  <?php

    //si no esta logeado
  } else {
    include "modulos/login.php";
  }
  ?>



  
  <!-- Scripts -->
  <script src="<?= $vistas; ?>/js/plantilla.js"></script>
  <script src="<?= $vistas; ?>/js/usuarios.js"></script>
  <script src="<?= $vistas; ?>/js/categorias.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= $vistas; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= $vistas; ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        "responsive": true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
        },
      });
    });
    </script>
    <script src="<?= $vistas; ?>/js/productos.js"></script>


</body>

</html>
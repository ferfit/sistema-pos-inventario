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


  <!-- jQuery -->
  <script src="./vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./vistas/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
<!--   <script src="./vistas/dist/js/demo.js"></script> -->

</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    
    <!-- Incluye nav superior -->
    <?php include 'modulos/nav.php' ;?>
    
    <!-- Incluye barra lateral -->
    <?php include 'modulos/aside.php' ;?>
    
    <!-- Contenido -->
    <?php
    if(isset($_GET['ruta'])){
      if( $_GET['ruta'] == "inicio" || 
          $_GET['ruta'] == "usuarios" ||
          $_GET['ruta'] == "categorias" ||
          $_GET['ruta'] == "productos" ||
          $_GET['ruta'] == "clientes" ||
          $_GET['ruta'] == "ventas" ||
          $_GET['ruta'] == "crear-venta" || 
          $_GET['ruta'] == "reportes" ){ 
        include 'modulos/'.$_GET['ruta'].'.php' ;
      }
    }

    ?>
    
    <!-- Footer -->
    <?php include 'modulos/footer.php' ;?>

    
  </div>
  <!-- ./wrapper -->
  
  <!-- Scripts -->
  <script src="js/plantilla.js"></script>
</body>

</html>
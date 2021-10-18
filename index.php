<?php

require_once('controladores/plantillaControlador.php');
require_once('controladores/usuariosControlador.php');
require_once('controladores/categoriasControlador.php');
require_once('controladores/productosControlador.php');
require_once('controladores/clientesControlador.php');
require_once('controladores/ventasControlador.php');

require_once('modelos/usuariosModelo.php');
require_once('modelos/categoriasModelo.php');
require_once('modelos/productosModelo.php');
require_once('modelos/clientesModelo.php');
require_once('modelos/ventasModelo.php');


//Cargamos plantilla principal
$plantilla = new PlantillaControlador();
$plantilla->ctrPlantilla();

?>
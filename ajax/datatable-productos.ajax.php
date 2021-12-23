<?php
/* requerimos ya que este archivo js se ejecuta dps del index*/
require_once('../controladores/productosControlador.php');
require_once('../modelos/productosModelo.php');
require_once('../controladores/categoriasControlador.php');
require_once('../modelos/categoriasModelo.php');



class TablaProductos
{

    /*----------------------------------------- */
    /*         Mostrar Productos                */
    /*----------------------------------------- */
    public function mostrarTablaProductos()
    {

        //Traemos los productos
        $productos = ProductosControlador::ctrMostrarProductos($item = null, $valor = null);

        //var_dump($productos);
        //die();

        //Armamos la estructura del html, se debe dejar todo seguido sin espacios
        $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>";
        $botones = " <div class='btn-group'><button class='btn btn-warning mr-2'><i class='fas fa-edit'></i></button><button class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></div>";

        //Armamos el bucle con su estructura
        $datosJson = '{
                        "data": [';

                        for ($i=0; $i < count($productos); $i++) { 
                            $datosJson.='[
                                "1",
                                "' . $imagen . '",
                                "00001",
                                "Taladros para ..",
                                "1",
                                "20",
                                "1500",
                                "2500",
                                "2011-04-25 00:00:00",
                                "' . $botones . '"
                            ],';
                        }

                        $datosJson = substr($datosJson,0,-1);

                        $datosJson.=']}';

        echo $datosJson;
    }
}


/*---- Instaciamos mostrar productos ----*/
$productos = new TablaProductos();
$productos->mostrarTablaProductos();

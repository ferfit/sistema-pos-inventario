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


        //Armamos el bucle con su estructura
        $datosJson = '{
                        "data": [';

                        for ($i=0; $i < count($productos); $i++) { 

                            //Armamos la estructura del html, se debe dejar todo seguido sin espacios
                            $imagen = "<img src='".$productos[$i]['imagen']."' width='40px'>";
                            $botones = " <div class='btn-group'><button class='btn btn-warning mr-2 btnEditarProducto' idProducto='".$productos[$i]['id']."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]['id']."' codigo='".$productos[$i]['codigo']."' imagen='".$productos[$i]['imagen']."'><i class='fas fa-trash-alt'></i></button></div>";
                            
                            if($productos[$i]['stock']<= 10){
                                $stock ="<button class='btn btn-danger'>".$productos[$i]['stock']."</button>";
                            } else if($productos[$i]['stock']>11 && $productos[$i]['stock'] <=15 ) {

                                $stock ="<button class='btn btn-warning'>".$productos[$i]['stock']."</button>";
                            } else {
                                $stock ="<button class='btn btn-success'>".$productos[$i]['stock']."</button>";
                            }
                            //Trae categoria
                            $item = "id";
                            $valor = $productos[$i]['id_categoria'];
                            $categorias = CategoriasControlador::ctrMostrarCategorias($item,$valor);
                            //
                            $datosJson.='[
                                "' . ($i+1) . '",
                                "' . $imagen . '",
                                "'.$productos[$i]['codigo'].'",
                                "'.$productos[$i]['descripcion'].'",
                                "'.$categorias['categoria'].'",
                                "'.$stock.'",
                                "$'.$productos[$i]['precio_compra'].'",
                                "$'.$productos[$i]['precio_venta'].'",
                                "'.$productos[$i]['fecha'].'",
                                "' . $botones . '"
                            ],';
                        }

                        //Elimina ultimo caracter
                        $datosJson = substr($datosJson,0,-1);

                        $datosJson.=']}';

        echo $datosJson;
    }
}


/*---- Instaciamos mostrar productos ----*/
$productos = new TablaProductos();
$productos->mostrarTablaProductos();

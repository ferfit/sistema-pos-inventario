<?php


class ProductosControlador{

    static public function ctrMostrarProductos($item,$valor){

        $tabla = "productos";

        $respuesta = ProductosModelo::mdlMostrarProductos($tabla,$item,$valor);

        return $respuesta;

        
    }
     
}


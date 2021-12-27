<?php

require_once('../controladores/productosControlador.php');
require_once('../modelos/productosModelo.php');
require_once('../controladores/categoriasControlador.php');
require_once('../modelos/categoriasModelo.php');

class AjaxProductos{

    public $idCategoria;
    /*---------------------------------------------------*/
    /*          Crear codigo del producto                */
    /*---------------------------------------------------*/
    public function ajaxCrearCodigoProducto(){
        
        $item="id_categoria";
        $valor = $this->idCategoria;
        
        $respuesta = ProductosControlador::ctrMostrarProductos($item,$valor);

        echo json_encode($respuesta);
        
    }

}

//Instanciamos crearCodigoProducto
if(isset($_POST['idCategoria'])){
    $codigoProducto = new AjaxProductos();
    $codigoProducto->idCategoria = $_POST['idCategoria'];
    $codigoProducto->ajaxCrearCodigoProducto();
}
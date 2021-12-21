<?php

require_once('../controladores/categoriasControlador.php');
require_once('../modelos/categoriasModelo.php');

class AjaxCategorias{

    /*----------------------------------------- */
    /*         Editar Categoria                 */
    /*----------------------------------------- */

    public $idCategoria;

    public function ajaxEditarCategoria(){

        $item = "id";
        $valor = $this->idCategoria;

        $respuesta = CategoriasControlador::ctrMostrarCategorias($item,$valor);

        echo json_encode($respuesta);

    }

}

/*Instanciamos editar categoria*/

if(isset($_POST['idCategoria'])){

    $editarCategoria = new AjaxCategorias();
    $editarCategoria->idCategoria = $_POST['idCategoria'];
    $editarCategoria->ajaxEditarCategoria();

}
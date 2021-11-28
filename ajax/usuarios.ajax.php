<?php

require_once('../controladores/usuariosControlador.php');
require_once('../modelos/usuariosModelo.php');


class AjaxUsuarios{
    /*----------------------------------------- */
    /*         Editar Usuario                   */
    /*----------------------------------------- */

    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item ="id";
        $valor = $this->idUsuario;

        $respuesta = UsuariosControlador::ctrMostrarUsuarios($item,$valor);

        echo json_encode($respuesta);

    }
}


//Instanciamos Editar Usuario

if(isset($_POST['idUsuario'])){
    
    $editar = new AjaxUsuarios;
    $editar->idUsuario = $_POST['idUsuario'];
    $editar->ajaxEditarUsuario();

}


?>


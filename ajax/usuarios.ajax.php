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

    /*----------------------------------------- */
    /*         Activar Usuario                  */
    /*----------------------------------------- */

    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario(){

        $tabla ="usuarios";
        $item1 = "estado";
        $valor1 = $this->activarUsuario;
        $item2 = "id";
        $valor2 = $this->activarId;

        //Se trabaja directamente con el modelo ya que se va a reutilizar el metodo mdlActivarUsuario para cargar la ultima hora de login
        $respuesta = Usuarios::mdlActivarUsuario($tabla,$item1,$valor1,$item2,$valor2);

    }


    /*----------------------------------------- */
    /*       QUE NO DUPLIQUE EL USUARIO         */
    /*----------------------------------------- */

    public $validarUsuario;

    public function ajaxValidarUsuario(){

        $item ="usuario";
        $valor = $this->validarUsuario;

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

//Instanciamos activar usuario

if(isset($_POST['activarUsuario'])){
    
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST['activarUsuario'];
    $activarUsuario->activarId = $_POST['activarId'];
    $activarUsuario->ajaxActivarUsuario();

}

//Instanciamos revisar que no se duplique el usuario

if(isset($_POST['validarUsuario'])){

    $valUsuario = new AjaxUsuarios();
    $valUsuario -> validarUsuario = $_POST['validarUsuario'];
    $valUsuario->ajaxValidarUsuario();
}

?>


<?php

class UsuariosControlador
{

    /*----------------------------------------- */
    /*         Ingreso de usuario               */
    /*----------------------------------------- */
    public function ctrIngresarUsuario()
    {

        //Validaciones
        if (isset($_POST['ingUsuario'])) {

            if (
                preg_match('/^[-a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                preg_match('/^[-a-zA-Z0-9]+$/', $_POST['ingPassword'])
            ) {
                //Variables 
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST['ingUsuario'];


                //Modelo
                $respuesta = Usuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                //var_dump($respuesta);

                if ($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $_POST['ingPassword']) {

                    //Creamos variable de sesión
                    $_SESSION['iniciarSesion'] = "ok";

                    echo '<script> 
                            window.location="inicio" 
                        </script>';
                } else {

                    echo '<div class="alert alert-danger mt-2"> Error al ingresar, vuelta a intentarlo.</div>';
                }
            }
        }
    }


    /*----------------------------------------- */
    /*             Crear usuario                */
    /*----------------------------------------- */

    public function ctrCrearUsuario()
    {
        //Validación 
        if (
            isset($_POST['nombre']) && !empty($_POST['nombre']) &&
            isset($_POST['usuario']) && !empty($_POST['usuario']) &&
            isset($_POST['password']) && !empty($_POST['password']) &&
            isset($_POST['perfil']) && !empty($_POST['perfil'])
        ) {

            //Validación de caracteres
            if (
                preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nombre']) &&
                preg_match('/^[-a-zA-Z0-9]+$/', $_POST['usuario']) &&
                preg_match('/^[-a-zA-Z0-9]+$/', $_POST['password'])
            ) {

                //variables
                $tabla = "usuarios";
                $datos = [
                    "nombre" => $_POST['nombre'],
                    "usuario" => $_POST['usuario'],
                    "password" => $_POST['password'],
                    "perfil" => $_POST['perfil']
                ];

                //Modelo
                $respuesta = Usuarios::mdlCrearUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo "  <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Exito!',
                                        text: 'El usuario se creó exitosamente.'
                                    }).then((result) => {
                                        window.location='usuarios'
                                      })
                                </script>";
                }

            } else {
                echo "  <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Los campos no pueden estar vacios o llevar caracteres especiales!'
                                }).then((result) => {
                                    window.location='usuarios'
                                  })
                            </script>";
            }
        }
    }
}

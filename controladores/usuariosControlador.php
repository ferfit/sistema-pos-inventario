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
                $encriptar = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');



                //Modelo
                $respuesta = Usuarios::mdlMostrarUsuarios($tabla, $item, $valor);


                if ($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $encriptar) {

                    //Creamos variables de sesión
                    $_SESSION['iniciarSesion'] = "ok";
                    $_SESSION['id'] = $respuesta['id'];
                    $_SESSION['nombre'] = $respuesta['nombre'];
                    $_SESSION['usuario'] = $respuesta['usuario'];
                    $_SESSION['foto'] = $respuesta['foto'];
                    $_SESSION['perfil'] = $respuesta['perfil'];


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

                /*----------------------------
                Validación de la imagen
                ----------------------------*/

                $ruta = "";

                if ($_FILES['foto']['tmp_name']) {

                    //Capturamos en un array el ancho y alto de la imagen que se sube
                    list($ancho, $alto) = getimagesize($_FILES['foto']['tmp_name']);

                    //Definimos el nuevo ancho y alto
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    //Creamos el directorio donde vamos a guardar la foto del usuario
                    $directorio = "vistas/img/usuarios/".$_POST['usuario'];

                    mkdir($directorio, 0755);

                    //Dependiendo del tipo de archivo, se ejecutara lo siguiente
                    if ($_FILES['foto']['type'] == "image/jpeg") {
                        
                        //Define codigo aleatorio
                        $aletorio = mt_rand(100,900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/usuarios/".$_POST['usuario']."/".$aletorio.".jpg";
                        //Define origen del archivo temporal
                        $origen = imagecreatefromjpeg($_FILES['foto']['tmp_name']);
                        //Crea una imagen con el nuevo tamaño
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        //Copia y cambia el tamaño de parte de una imagen
                        imagecopyresized($destino, $origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                        // guarda la foto modifica en al ruta que definimos
                        imagejpeg($destino, $ruta);

                    }
                    // Si es png
                    if ($_FILES['foto']['type'] == "image/png") {
                        
                        //Define codigo aleatorio
                        $aletorio = mt_rand(100,900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/usuarios/".$_POST['usuario']."/".$aletorio.".png";
                        //Define origen del archivo temporal
                        $origen = imagecreatefrompng($_FILES['foto']['tmp_name']);
                        //Crea una imagen con el nuevo tamaño
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        //Copia y cambia el tamaño de parte de una imagen
                        imagecopyresized($destino, $origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                        // guarda la foto modifica en al ruta que definimos
                        imagepng($destino, $ruta);

                    }
                    
                }

                //variables
                $tabla = "usuarios";

                $encriptar = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = [
                    "nombre" => $_POST['nombre'],
                    "usuario" => $_POST['usuario'],
                    "password" => $encriptar,
                    "foto" => $ruta,
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

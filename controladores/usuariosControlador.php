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

                    if ($respuesta['estado'] == 1) {

                        //Creamos variables de sesión
                        $_SESSION['iniciarSesion'] = "ok";
                        $_SESSION['id'] = $respuesta['id'];
                        $_SESSION['nombre'] = $respuesta['nombre'];
                        $_SESSION['usuario'] = $respuesta['usuario'];
                        $_SESSION['foto'] = $respuesta['foto'];
                        $_SESSION['perfil'] = $respuesta['perfil'];

                        //Capturamos fecha y hora actual para definir ultimo login
                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $fechaActual = $fecha . ' ' . $hora;

                        $tabla = "usuarios";

                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;

                        $item2 = "id";
                        $valor2 = $respuesta['id'];

                        $ultimoLogin = Usuarios::mdlActivarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        if ($ultimoLogin == "ok") {
                            echo '<script> 
                                window.location="inicio" 
                            </script>';
                        }
                    } else {
                        echo '<div class="alert alert-danger mt-2"> Error, el usuario no esta activado.</div>';
                    }
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
                    $directorio = "vistas/img/usuarios/" . $_POST['usuario'];

                    mkdir($directorio, 0755);

                    //Dependiendo del tipo de archivo, se ejecutara lo siguiente
                    if ($_FILES['foto']['type'] == "image/jpeg") {

                        //Define codigo aleatorio
                        $aletorio = mt_rand(100, 900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/usuarios/" . $_POST['usuario'] . "/" . $aletorio . ".jpg";
                        //Define origen del archivo temporal
                        $origen = imagecreatefromjpeg($_FILES['foto']['tmp_name']);
                        //Crea una imagen con el nuevo tamaño
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        //Copia y cambia el tamaño de parte de una imagen
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        // guarda la foto modifica en al ruta que definimos
                        imagejpeg($destino, $ruta);
                    }
                    // Si es png
                    if ($_FILES['foto']['type'] == "image/png") {

                        //Define codigo aleatorio
                        $aletorio = mt_rand(100, 900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/usuarios/" . $_POST['usuario'] . "/" . $aletorio . ".png";
                        //Define origen del archivo temporal
                        $origen = imagecreatefrompng($_FILES['foto']['tmp_name']);
                        //Crea una imagen con el nuevo tamaño
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        //Copia y cambia el tamaño de parte de una imagen
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
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

    /*----------------------------------------- */
    /*         Mostrar Usuarios                  */
    /*----------------------------------------- */
    static public function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";

        //Modelo
        $respuesta = Usuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /*----------------------------------------- */
    /*         Editar  Usuario                  */
    /*----------------------------------------- */

    public function ctrEditarUsuario()
    {

        if (isset($_POST['editarUsuario'])) {

            if (
                preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])
            ) {

                /*----------------------------
                Validación de la imagen
                ----------------------------*/

                $ruta = $_POST['fotoActual'];

                if (isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES['editarFoto']['tmp_name'])) {

                    //Capturamos en un array el ancho y alto de la imagen que se sube
                    list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);

                    //Definimos el nuevo ancho y alto
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    //Definimos directorio donde vamos a guardar la nueva foto del usuario
                    $directorio = "vistas/img/usuarios/" . $_POST['editarUsuario'];

                    //Chequeamos si existe una imagen en la BD
                    if (!empty($_POST['fotoActual'])) {
                        //borramos el archivo del a carpeta
                        unlink($_POST['fotoActual']);
                    } else {
                        //Creamos la carpeta
                        mkdir($directorio, 0755);
                    }

                    //Dependiendo del tipo de archivo, se ejecutara lo siguiente
                    if ($_FILES['editarFoto']['type'] == "image/jpeg") {

                        //Define codigo aleatorio
                        $aletorio = mt_rand(100, 900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/usuarios/" . $_POST['editarUsuario'] . "/" . $aletorio . ".jpg";
                        //Define origen del archivo temporal
                        $origen = imagecreatefromjpeg($_FILES['editarFoto']['tmp_name']);
                        //Crea una imagen con el nuevo tamaño
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        //Copia y cambia el tamaño de parte de una imagen
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        // guarda la nueva foto modifica en al ruta que definimos
                        imagejpeg($destino, $ruta);
                    }
                    // Si es png
                    if ($_FILES['editarFoto']['type'] == "image/png") {

                        //Define codigo aleatorio
                        $aletorio = mt_rand(100, 900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/usuarios/" . $_POST['editarUsuario'] . "/" . $aletorio . ".png";
                        //Define origen del archivo temporal
                        $origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);
                        //Crea una imagen con el nuevo tamaño
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        //Copia y cambia el tamaño de parte de una imagen
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        // guarda la foto modifica en al ruta que definimos
                        imagepng($destino, $ruta);
                    }
                }

                //variables
                $tabla = "usuarios";


                //Validacion campo contraseña
                if ($_POST['editarPassword'] != "") {

                    if (preg_match('/^[-a-zA-Z0-9]+$/', $_POST['editarPassword'])) {

                        $encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        echo "  <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '¡La contraseña no puede ir vacia o llevar caracteres especiales!'
                                    }).then((result) => {
                                        window.location='usuarios'
                                    })
                                </script>";
                    }
                } else {

                    $encriptar = $_POST['passwordActual'];
                }

                //Definimos array con los valores de los nuevos campos
                $datos = [
                    "nombre" => $_POST['editarNombre'],
                    "usuario" => $_POST['editarUsuario'],
                    "password" => $encriptar,
                    "foto" => $ruta,
                    "perfil" => $_POST['editarPerfil']
                ];


                //Modelo
                $respuesta = Usuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo "  <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Exito!',
                                        text: 'El usuario se editó exitosamente.'
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
                                    text: 'Los campo 'Nombre' no pueden estar vacío o llevar caracteres especiales!'
                                }).then((result) => {
                                    window.location='usuarios'
                                  })
                            </script>";
            }
        }
    }

    /*----------------------------------------- */
    /*         Eliminar Usuario                 */
    /*----------------------------------------- */

    static public function ctrEliminarUsuario()
    {

        if (isset($_GET['idUsuario'])) {

            $tabla = "usuarios";
            $datos = $_GET['idUsuario'];

            if ($_GET['fotoUsuario'] != "") {

                unlink($_GET['fotoUsuario']); //Borramos archivo
                rmdir('vistas/img/usuarios/'.$_GET['usuario']); //Borramos carpeta
            }

            $respuesta = Usuarios::mdlEliminarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo "  <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito!',
                                text: 'El usuario se eliminó exitosamente.'
                            }).then((result) => {
                                window.location='usuarios'
                                })
                        </script>";
            }
        }
    }
}

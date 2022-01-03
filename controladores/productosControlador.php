<?php


class ProductosControlador
{

    static public function ctrMostrarProductos($item, $valor)
    {

        $tabla = "productos";

        $respuesta = ProductosModelo::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }

    /*----------------------------------------- */
    /*             Crear producto               */
    /*----------------------------------------- */

    static public function ctrCrearProducto()
    {

        //Validación
        if (isset($_POST['descripcion'])) {

            if (
                preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['descripcion']) &&
                preg_match('/^[0-9 ]+$/', $_POST['stock']) &&
                preg_match('/^[0-9.]+$/', $_POST['precioCompra']) &&
                preg_match('/^[0-9.]+$/', $_POST['precioVenta'])) {
                
                /*----------------------------
                Validación de la imagen
                ----------------------------*/

                $ruta = "vistas/img/productos/default/anonymous.png";

                if ($_FILES['foto']['tmp_name']) {

                    //Capturamos en un array el ancho y alto de la imagen que se sube
                    list($ancho, $alto) = getimagesize($_FILES['foto']['tmp_name']);

                    //Definimos el nuevo ancho y alto
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    //Creamos el directorio donde vamos a guardar la foto del producto
                    $directorio = "vistas/img/productos/".$_POST['codigo'];

                    mkdir($directorio, 0755);

                    //Dependiendo del tipo de archivo, se ejecutara lo siguiente
                    if ($_FILES['foto']['type'] == "image/jpeg") {

                        //Define codigo aleatorio
                        $aletorio = mt_rand(100, 900);
                        //Define ruta donde se va a guardar
                        $ruta = "vistas/img/productos/" . $_POST['codigo'] . "/" . $aletorio . ".jpg";
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
                        $ruta = "vistas/img/productos/" . $_POST['codigo'] . "/" . $aletorio . ".png";
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
                
                $tabla = "productos";
                $datos =[
                        "id_categoria" => $_POST['categoria'],
                        "codigo" => $_POST['codigo'],
                        "descripcion" => $_POST['descripcion'],
                        "stock" => $_POST['stock'],
                        "precio_compra" => $_POST['precioCompra'],
                        "precio_venta" => $_POST['precioVenta'],
                        "imagen" => $ruta
                        ];

                        
                //Modelo
                $respuesta = ProductosModelo::mdlCrearProducto($tabla,$datos);
                
                if($respuesta == "ok"){

                    echo "  <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Exito!',
                                    text: 'El producto se creó exitosamente.'
                                }).then((result) => {
                                    window.location='productos'
                                })
                            </script>";

                } 

            } else {

                echo "  <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'El producto no pueden estar vacia o llevar caracteres especiales!'
                                }).then((result) => {
                                    window.location='productos'
                                    })
                            </script>";
            }
        }
    }
}

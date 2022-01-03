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
                preg_match('/^[0-9 ]+$/', $_POST['precioCompra']) &&
                preg_match('/^[0-9 ]+$/', $_POST['precioVenta'])) {
                
                
                //variables
                $ruta = "vistas/img/productos/default/anonymous.png";
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
                var_dump($respuesta);die();
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

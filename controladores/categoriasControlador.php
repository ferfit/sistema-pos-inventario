<?php

class CategoriasControlador
{

    public function ctrPlantilla()
    {
        include "vistas/plantilla.php";
    }


    /*----------------------------------------- */
    /*         Crear Categoria                  */
    /*----------------------------------------- */
    public function ctrCrearCategoria()
    {
        //Validación
        if (isset($_POST['nombreCategoria'])) {
            
            //Validación de caracteres
            if (preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nombreCategoria'])) {


                //Variables
                $tabla = "categorias";
                $datos = $_POST['nombreCategoria'];

                //Modelo 
                $respuesta = CategoriasModelo::mdlCrearCategoria($tabla,$datos);

                if($respuesta == "ok"){

                    echo "  <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Exito!',
                                    text: 'La categoría se creó exitosamente.'
                                }).then((result) => {
                                    window.location='categorias'
                                })
                            </script>";

                } 



            } else {
                echo "  <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'La categoría no pueden estar vacia o llevar caracteres especiales!'
                            }).then((result) => {
                                window.location='categorias'
                                })
                        </script>";
            }
        }
    }

    /*----------------------------------------- */
    /*      Mostrar Categorias/ Ver Categoria   */
    /*----------------------------------------- */
    static public function ctrMostrarCategorias($item,$valor){

        $tabla = "categorias";

        $respuesta = CategoriasModelo::mdlMostrarCategorias($tabla,$item,$valor);

        return $respuesta;

    }

    /*----------------------------------------- */
    /*      Editar Categoria                    */
    /*----------------------------------------- */
    public function ctrEditarCategoria()
    {
        //Validación
        if (isset($_POST['editarCategoria'])) {
            
            //Validación de caracteres
            if (preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarCategoria'])) {


                //Variables
                $tabla = "categorias";
                $datos = array(
                                "categoria"=>$_POST['editarCategoria'],
                                "id"=>$_POST['idCategoria'],
                            );

                //Modelo 
                $respuesta = CategoriasModelo::mdlEditarCategoria($tabla,$datos);

                if($respuesta == "ok"){

                    echo "  <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Exito!',
                                    text: 'La categoría se modificó exitosamente.'
                                }).then((result) => {
                                    window.location='categorias'
                                })
                            </script>";

                } 



            } else {
                echo "  <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'La categoría no pueden estar vacia o llevar caracteres especiales!'
                            }).then((result) => {
                                window.location='categorias'
                                })
                        </script>";
            }
        }
    }

    /*----------------------------------------- */
    /*      Eliminar Categoria                  */
    /*----------------------------------------- */
    public function ctrEliminarCategoria(){
        if(isset($_GET['idCategoria'])){
            $tabla = "categorias";
            $datos = $_GET['idCategoria'];

            $respuesta = CategoriasModelo::mdlEliminarCategoria($tabla,$datos);

            if($respuesta == "ok"){
                echo  " <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito!',
                                text: 'La categoria se eliminó exitosamente.'
                            }).then((result) => {
                                window.location='categorias'
                                })
                        </script>";
            }
        }
    }

}

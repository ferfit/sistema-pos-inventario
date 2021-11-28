/*------------------------------------------
PREVISUALIZACION LA FOTO QUE SE SELECCIONA
------------------------------------------*/

$(".foto").change(function(){

    var imagen = this.files[0]; //console.log

    //Validacion de tipo de archivo
    if(imagen['type'] != "image/jpeg" && imagen['type'] != "image/png" ){
        //Limpiamos el input
        $(".foto").val()

        Swal.fire({
            icon: 'error',
            title: 'Error al subir la imagen!',
            text: 'La imagen debe estar en formato JPG o PNG'
        })

    //Validacion de tamaño de archivo
    } else if(imagen['size'] > 2000000){

        $(".foto").val()

        Swal.fire({
            icon: 'error',
            title: 'Error al subir la imagen!',
            text: 'La imagen no puede pesar más de 2 mb.'
        })

    } else {

        //Cargamos la imagen
        var datosImagen = new FileReader
        datosImagen.readAsDataURL(imagen)

        $(datosImagen).on("load",function(e){
            var rutaImagen = e.target.result
            $(".imagenFoto").attr("src", rutaImagen)
        })
    }


})

/*------------------------------------------
EDITAR USUARIO
------------------------------------------*/
$('.btnEditarUsuario').click(function(){

    //Variables
    var idUsuario = $(this).attr("idUsuario");
    console.log(idUsuario);

    var datos = new FormData();
    datos.append("idUsuario",idUsuario); // el 2° param es la variable anterior

    //Petición ajax
    $.ajax({
        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success: function(respuesta){
            
            console.log("respuesta");
            console.log(respuesta);
            //Cargar datos en input
            $("#editarNombre").val(respuesta['nombre']);
            $("#editarUsuario").val(respuesta['usuario']);
            $("#editarPerfil").html(respuesta['perfil']);
            $("#editarPerfil").val(respuesta['perfil']);

            $("#passwordActual").val(respuesta['password']);
            $("#fotoActual").val(respuesta['foto']);

            if(respuesta['foto'] != ""){
                $(".previsualizar").attr("src",respuesta['foto']);
            } else {
                $(".previsualizar").attr("src","vistas/img/usuarios/default/anonymous.png");
            }
        }

    });

});
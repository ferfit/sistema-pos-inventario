/*---------------------------------
PREVISUALIZACION LA FOTO QUE SE SELECCIONA
---------------------------------*/

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
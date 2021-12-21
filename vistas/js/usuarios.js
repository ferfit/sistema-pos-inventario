/*------------------------------------------
PREVISUALIZACION LA FOTO QUE SE SELECCIONA
------------------------------------------*/

$(".foto").change(function () {

    var imagen = this.files[0]; //console.log

    //Validacion de tipo de archivo
    if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png") {
        //Limpiamos el input
        $(".foto").val()

        Swal.fire({
            icon: 'error',
            title: 'Error al subir la imagen!',
            text: 'La imagen debe estar en formato JPG o PNG'
        })

        //Validacion de tamaño de archivo
    } else if (imagen['size'] > 2000000) {

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

        $(datosImagen).on("load", function (e) {
            var rutaImagen = e.target.result
            $(".imagenFoto").attr("src", rutaImagen)
        })
    }


})

/*------------------------------------------
EDITAR USUARIO
------------------------------------------*/
$(document).on('click', '.btnEditarUsuario', function () {

    //Variables
    var idUsuario = $(this).attr("idUsuario");
    console.log(idUsuario);

    var datos = new FormData();
    datos.append("idUsuario", idUsuario); // el 2° param es la variable anterior

    //Petición ajax
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            //console.log("respuesta");
            //console.log(respuesta);
            //Cargar datos en input
            $("#editarNombre").val(respuesta['nombre']);
            $("#editarUsuario").val(respuesta['usuario']);
            $("#editarPerfil").html(respuesta['perfil']);
            $("#editarPerfil").val(respuesta['perfil']);

            $("#passwordActual").val(respuesta['password']);
            $("#fotoActual").val(respuesta['foto']);

            if (respuesta['foto'] != "") {
                $(".previsualizar").attr("src", respuesta['foto']);
            } else {
                $(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");
            }
        }

    });

});

/*------------------------------------------
ACTIVAR USUARIO
------------------------------------------*/

$(document).on('click', '.btnActivar', function () {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {

            Swal.fire({
                icon: 'success',
                title: 'Exito!',
                text: 'El estado del usuario se actualizó exitosamente.'
            }).then((result) => {
                window.location = 'usuarios'
            })

        }

    })

    if (estadoUsuario == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);
    } else {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);
    }


})

/*------------------------------------------
REVISAR QUE NO SE DUPLIQUE USUARIO
------------------------------------------*/
$('#usuario').change(function () {

    var usuario = $(this).val();

    $('.alert').remove();

    var datos = new FormData();
    datos.append('validarUsuario', usuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            if (data) {
                $('#usuario').parent().after('<div class="alert alert-warning">El nombre de usuario ya existe.</div>');
                $('#usuario').val("");
            }
        }

    })
})

/*------------------------------------------
ELIMINAR USUARIO
------------------------------------------*/
$(document).on('click', '.btnEliminarUsuario', function () {

    var idUsuario = $(this).attr('idUsuario');
    var fotoUsuario = $(this).attr('fotoUsuario');
    var usuario = $(this).attr('usuario');

    console.log(idUsuario)
    console.log(fotoUsuario)

    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta acción no se podrá revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar usuario!'
    }).then((result) => {
        if (result.isConfirmed) {

            //Como estamos trabajando con rutas amigables configuradas, debemos escribir la ruta absoluta.
            window.location = `index.php?ruta=usuarios&idUsuario=${idUsuario}&fotoUsuario=${fotoUsuario}&usuario=${usuario}`;
        }
    })


})
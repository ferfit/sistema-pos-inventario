$(document).ready(function(){

})

/*----------------------------------------- */
/*         Editar Categoria                 */
/*----------------------------------------- */
$('.btnEditarCategoria').click(function(){
    var idCategoria = $(this).attr('idCategoria');
    
    var datos = new FormData();
    datos.append('idCategoria',idCategoria);

    //Petición ajax
    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $('#editarCategoria').val(respuesta['categoria']);
            $('#idCategoria').val(respuesta['id']);
            
        }

    });
    
})

/*----------------------------------------- */
/*         Eliminar Categoria               */
/*----------------------------------------- */
$('.btnEliminarCategoria').click(function(){
    
    var idCategoria = $(this).attr('idCategoria');
    console.log(idCategoria);

    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta acción no se podrá revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar categoría!'
    }).then((result) => {
        if (result.isConfirmed) {

            //Como estamos trabajando con rutas amigables configuradas, debemos escribir la ruta absoluta.
            window.location = `index.php?ruta=categorias&idCategoria=${idCategoria}`;

        }
    })
})
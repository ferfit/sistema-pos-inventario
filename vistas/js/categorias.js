$(document).ready(function(){

})

/*----------------------------------------- */
/*         Editar Categoria                  */
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
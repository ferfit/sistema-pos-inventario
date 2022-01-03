/*------------------------------------------
Mostrar productos dinamicamente con datatable
------------------------------------------*/
/* codigo para ver por consola lo que trae 
$.ajax({
    url:"ajax/datatable-productos.ajax.php",
    success:function(rta){
        console.log(rta)
    }
})*/

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender":true,
    "retrieve":true,
    "processing":true,
    "responsive": true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
        }
} );

/*------------------------------------------
Captura categoria para hacer dinamico el input codigo
------------------------------------------*/
$('#categoria').change(function(){
    var idCategoria = $(this).val();

    var datos = new FormData();
    datos.append('idCategoria',idCategoria);
    console.log(idCategoria);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method:"POST",
        data:datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(rta){
            
            if(!rta){
                var nuevoCodigo = idCategoria +"01";
                $('#codigo').val(nuevoCodigo);
            } else {
                var nuevoCodigo = Number(rta['codigo'])+1;
                $('#codigo').val(nuevoCodigo);
            }
        }
    })

    
})

/*--------------------------------------------------
Agregando precio de venta dinamico
---------------------------------------------------*/
$('#precioCompra').change(function(){

    if($('.checkPorcentaje').prop('checked')){

        var precioCompra = $('#precioCompra').val();

        var porcentaje = $('#porcentaje').val();

        var precioVenta = Number((precioCompra*porcentaje/100)) + Number(precioCompra);

        console.log(precioVenta);

        $('#precioVenta').val(precioVenta);
        $('#precioVenta').prop('readonly',true);

    }


})


/*--------------------------------------------------
Cambio de porcentaje
---------------------------------------------------*/
$('#porcentaje').change(function(){

    if($('.checkPorcentaje').prop('checked')){

        cambiaPrecioVenta();


    }

})

/*--------------------------------------------------
Si se cambia el check de utilizar porcentaje
---------------------------------------------------*/

$('.checkPorcentaje').change(function(){

    if( $(this).is(':checked') ) {

        cambiaPrecioVenta();

    } else {

        $('#precioVenta').prop('readonly',false);

    }

})

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



/*Funciones*/

function cambiaPrecioVenta(){

    var precioCompra = $('#precioCompra').val();

    var porcentaje = $('#porcentaje').val();

    var precioVenta = Number((precioCompra*porcentaje/100)) + Number(precioCompra);

    console.log(precioVenta);

    $('#precioVenta').val(precioVenta);

    $('#precioVenta').prop('readonly',true);


}

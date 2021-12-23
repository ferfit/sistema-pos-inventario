/*------------------------------------------
Mostrar productos dinamicamente con datatable
------------------------------------------*/

$.ajax({
    url:"ajax/datatable-productos.ajax.php",
    success:function(rta){
        console.log(rta)
    }
})

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php"
} );

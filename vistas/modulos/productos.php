<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Productos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar productos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          <i class="far fa-plus-square"></i> Crear Producto
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table  class="table table-striped table-bordered tablaProductos" style="width:100%">

          <thead>
            <tr>
              <th>#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio Compra</th>
              <th>Precio Venta</th>
              <th>Agregado</th>
              <th>Acciones</th>
            </tr>
          </thead>



          <tbody>

            <?php
            /*
            $productos = ProductosControlador::ctrMostrarProductos($item = null, $valor = null);

            foreach ($productos as $key => $producto) {
              echo '
                    <tr>
                      <td>'.$producto['id'].'</td>
                      <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px" alt=""></td>
                      <td>'.$producto['codigo'].'</td>
                      <td>'.$producto['descripcion'].' </td>';

                      //Buscamos la categoria segun el id
                      $item = "id";
                      $valor = $producto['id_categoria'];

                      $categoria = CategoriasControlador::ctrMostrarCategorias($item,$valor);

                      echo '<td>'.$categoria['categoria'].'</td>
                      <td>'.$producto['stock'].'</td>
                      <td>'.$producto['precio_compra'].'</td>
                      <td>'.$producto['precio_venta'].'</td>
                      <td>'.$producto['fecha'].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning mr-2 btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger btnEliminarProducto"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                ';
            }
            */
            ?>


          </tbody>
          <tfoot>
          
            <tr>
              <th>#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio Compra</th>
              <th>Precio Venta</th>
              <th>Agregado</th>
              <th>Acciones</th>
            </tr> 
          </tfoot>
        </table>
      </div>
    </div>
  </section>
</div>



<!-----------------------------------------
MODAL CREAR PRODUCTO
--------------------------------------- -->
<div class="modal fade" id="modalAgregarProducto" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Agregar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card-body">

            <!-- Categoria -->
            <div class="form-group">
              <select name="categoria" class="form-control" id="categoria" required>
                <option value="">Seleccione una categoría</option>

                <?php
                $categorias = CategoriasControlador::ctrMostrarCategorias($item=null,$valor=null);

                foreach ($categorias as $categoria) {
                  echo '<option value="'.$categoria['id'].'">'.$categoria['categoria'].'</option>';
                }
                ?>

              </select>
            </div>
            <!-- Codigo -->
            <div class="form-group">
              <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingresar Codigo" readonly required>
            </div>

            <!-- Descripción -->
            <div class="form-group">
              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingresar Descripción" required>
            </div>

            <!-- Stock -->
            <div class="form-group">
              <input type="number" class="form-control" name="stock" id="stock" min="0" placeholder="Ingresar el Stock" required>
            </div>

            <div class="form-group row">
              <!-- Precio Compra -->
              <div class="input-group col-6">
                <input type="number" class="form-control" name="precioCompra" id="precioCompra" min="0" placeholder="Precio de compra" required>
              </div>

              <!-- Precio Venta -->
              <div class="input-group col-6">
                <input type="number" class="form-control" name="precioVenta" id="precioVenta" min="0" placeholder="Precio de venta" required>
              </div>
            </div>
            <!-- Porcentaje -->

            <div class="col-6 mb-3">
              <div class="icheck-danger d-inline">
                <input type="checkbox" checked id="checkboxDanger1" class="checkPorcentaje">
                <label for="checkboxDanger1">Utilizar porcentaje
                </label>
              </div>
            </div>



            <div class="col-6 row">
              <div class="input-group">
                <input type="number" class="form-control input-lg col-md-4" name="porcentaje" id="porcentaje" min="0" value="40" placeholder="I">
                <span class="input-group-addon form-control col-4 col-md-3"><i class="fa fa-percent"></i></span>
              </div>
            </div>

            <!-- Foto -->
            <div class="form-group mt-3">
              <label for="foto">Subir imagén</label> <br>
              <input type="file" name="imagen" id="imagen" class="foto">
              <p class="text-danger mt-2">Peso máximo de la foto 2 mb.</p>
              <img src="<?= $vistas; ?>/img/productos/default/anonymous.png" alt="" width="40px" class="imagenFoto">
            </div>


          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php

        //$crearUsuario = new UsuariosControlador();
        //$crearUsuario->ctrCrearUsuario();

        ?>

      </form>
    </div>
  </div>
</div>

<!-----------------------------------------
MODAL EDITAR PRODUCTO
--------------------------------------- -->
<div class="modal fade" id="modalEditarProducto" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Editar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card-body">
            <!-- Nombre -->
            <div class="form-group">
              <input type="text" class="form-control" name="editarNombre" id="editarNombre" value="" required>
            </div>

            <!-- Usuario -->
            <div class="form-group">
              <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" value="" required readonly>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" name="editarPassword" id="editarPassword" placeholder="Escriba una nueva contraseña">
              <input type="hidden" name="passwordActual" id="passwordActual">
            </div>

            <!-- Perfil -->
            <div class="form-group">
              <select name="editarPerfil" class="form-control" required>
                <option value="" id="editarPerfil"></option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>

            <!-- Foto -->
            <div class="form-group">
              <label for="foto">Subir foto</label> <br>
              <input type="file" name="editarFoto" id="foto" class="foto">
              <p class="text-danger mt-2">Peso máximo de la foto 2 mb.</p>
              <img src="" alt="" width="40px" class="imagenFoto previsualizar">

              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>


          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Modificar usuarios</button>
        </div>

        <?php

        //$editarUsuario = new UsuariosControlador();
        //$editarUsuario->ctrEditarUsuario();

        ?>

      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-----------------------------------------
ELIMINAR PRODUCTO
--------------------------------------- -->
<?php

//$eliminarUsuario = new UsuariosControlador();
//$eliminarUsuario->ctrEliminarUsuario();

?>
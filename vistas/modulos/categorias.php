<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Categorías</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar categorías</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          <i class="far fa-plus-square"></i> Crear Categoria
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">

          <thead>
            <tr>
              <th>#</th>
              <th>Categoria</th>
              <th>Acciones</th>
            </tr>
          </thead>



          <tbody>

            <tr>
              <td>1</td>
              <td>Taladros</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning mr-2"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>1</td>
              <td>Taladros</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning mr-2"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>1</td>
              <td>Taladros</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning mr-2"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
              </td>
            </tr>

          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Categoria</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-----------------------------------------
MODAL CREAR CATEGORIA
--------------------------------------- -->
<div class="modal fade" id="modalAgregarCategoria" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Agregar Categoría</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card-body">
            <!-- Nombre -->
            <div class="form-group">
              <input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria" placeholder="Ingresar Categoría" required>
            </div>

          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>

    <?php
    $crearCategoria = new CategoriasControlador();
    $crearCategoria->ctrCrearCategoria();



    ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
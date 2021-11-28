<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          <i class="far fa-plus-square"></i> Crear Usuario
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">

          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>



          <tbody>

            <?php

            $item = null;
            $valor = null;

            $usuarios = UsuariosControlador::ctrMostrarUsuarios($item, $valor);


            foreach ($usuarios as $key => $usuario) {

              /* var_dump("<pre></pre>");
              var_dump($usuario);
              var_dump("<pre></pre>"); */

              echo '
              <tr>
                <td>'.$usuario['id'].'</td>
                <td>'.$usuario['nombre'].'</td>
                <td>'.$usuario['usuario'].'</td>';

                if($usuario['foto'] != ""){

                  echo '
                  <td>
                    <img src="'.$usuario['foto'].'" alt="" width="40px">
                  </td>';

                } else {
                  echo '
                  <td>
                    <img src="vistas/img/usuarios/default/anonymous.png" alt="" width="40px">
                  </td>
                  ';
                }

                echo '<td>'.$usuario['perfil'].'</td>
                <td>
                  <small class="badge badge-success"> '.$usuario['estado'].' </small>
                </td>
                <td>'.$usuario['ultimo_login'].'</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning mr-2 btnEditarUsuario" idUsuario="'.$usuario['id'].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </td>
              </tr>
              ';
            }

            ?>

          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
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
MODAL CREAR USUARIO
--------------------------------------- -->
<div class="modal fade" id="modalAgregarUsuario" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Agregar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card-body">
            <!-- Nombre -->
            <div class="form-group">
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar Nombre" required>
            </div>

            <!-- Usuario -->
            <div class="form-group">
              <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingresar Usuario" required>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar contraseña" required>
            </div>

            <!-- Perfil -->
            <div class="form-group">
              <select name="perfil"  class="form-control" required>
                <option value="">Seleccione un perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>

            <!-- Foto -->
            <div class="form-group">
              <label for="foto">Subir foto</label> <br>
              <input type="file" name="foto" id="foto" class="foto">
              <p class="text-danger mt-2">Peso máximo de la foto 2 mb.</p>
              <img src="<?= $vistas; ?>/img/usuarios/default/anonymous.png" alt="" width="40px" class="imagenFoto">
            </div>


          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php

        $crearUsuario = new UsuariosControlador();
        $crearUsuario->ctrCrearUsuario();

        ?>

      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-----------------------------------------
MODAL EDITAR CREAR USUARIO
--------------------------------------- -->
<div class="modal fade" id="modalEditarUsuario" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST"  enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Editar Usuario</h4>
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
              <input type="password" class="form-control" name="editarPassword" id="editarPassword" placeholder="Escriba una nueva contraseña" required>
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
              <img src="" alt="" width="40px" class="imagenFoto previsualizar" >

              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>


          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Modificar usuarios</button>
        </div>

        <?php

        $editarUsuario = new UsuariosControlador();
        $editarUsuario->ctrEditarUsuario();

        ?>

      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
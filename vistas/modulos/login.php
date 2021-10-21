
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html">Sistema <b>POS Inventario</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card shadow">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresar al sistema</p>

      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block shadow">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>


        <?php
            $login = new UsuariosControlador();
            $login->ctrIngresarUsuario();
            
        ?>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Proveedores</title>

  <link rel="stylesheet" href="assets/css/estilo.css" />
  <link rel="stylesheet" href="assets/css/menu.css" />
  <link rel="stylesheet" href="assets/css/usuarios.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Special+Gothic:wght@400..700&display=swap" rel="stylesheet">
  <!-- Bootstrap icons and Bootstrap 4 stylesheet (using local Bootstrap 4 JS below) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <!-- SIDEBAR FIJO -->
  <nav class="sidebar">
    <?php require_once("comunes/menu.php"); ?>
  </nav>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="main-content">
    <div class="header">
      <h1 class="header-standar">Proveedores</h1>
    </div>

    <div class="container-all">
      <div class="container-header">
        <?php
        if (in_array("agregar_proveedores", $nivel1)) {
          ?>
          <button class="btn-standar" data-toggle="modal" data-target="#loginModal">Agregar Proveedor
            <?php if (isset($mensaje)) {
              echo $mensaje;
            } ?></button>

          <?php
        }
        ?>
      </div>

      <div class="user-table">
        <table class="table table-bordered text-center align-middle">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Dirección</th>
              <th>Descripción</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (in_array("consutar_proveedores", $nivel1)) {
              if (isset($consult)) {
                echo $consult;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal de Agregar -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registrar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="user">Nombre</label>
                  <span id="snombre" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="nombre" name="nombre"
                    placeholder="Escriba el nombre del proveedor" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password">Apellido</label>
                  <span id="sapellido" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="apellido" name="apellido"
                    placeholder="Escriba el apellido del proveedor" autofocus>
                </div>
                <div class="mb-3">
                  <label for="email">Correo</label>
                  <span id="scorreo" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="correo" name="correo"
                    placeholder="Escriba el correo" autofocus>
                </div>
                <div class="mb-3">
                  <label for="telephone">Telefono</label>
                  <span id="stelefono" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="telefono" name="telefono"
                    placeholder="Escriba el n° de telefono" autofocus>
                </div>
                <div class="mb-3">
                  <label for="direction">Dirección</label>
                  <span id="sdireccion" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="direccion" name="direccion"
                    placeholder="Escriba la dirección" autofocus>
                </div>
                <div class="mb-3">
                  <label for="description">Descripción</label>
                  <span id="sdescripcion" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="descripcion" name="descripcion"
                    placeholder="Escriba una descripcion" autofocus>
                </div>
                <button type="button" class="btn w-100" id="enviar">Registrar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="loginModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="userm">Nombre</label>
                  <span id="snombrem" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="nombrem" name="nombrem"
                    placeholder="Escriba el nombre del proveedor" autofocus>
                </div>
                <div class="mb-3">
                  <label for="passwordm">Apellido</label>
                  <span id="sapellidom" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="apellidom" name="apellidom"
                    placeholder="Escriba el apellido del proveedor" autofocus>
                </div>
                <div class="mb-3">
                  <label for="emailm">Correo</label>
                  <span id="scorreom" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="correom" name="correom"
                    placeholder="Escriba el correo" autofocus>
                </div>
                <div class="mb-3">
                  <label for="telephonem">Telefono</label>
                  <span id="stelefonom" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="telefonom" name="telefonom"
                    placeholder="Escriba el n° de telefono" autofocus>
                </div>
                <div class="mb-3">
                  <label for="directionm">Dirección</label>
                  <span id="sdireccionm" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="direccionm" name="direccionm"
                    placeholder="Escriba la dirección" autofocus>
                </div>
                <div class="mb-3">
                  <label for="descriptionm">Descripción</label>
                  <span id="sdescripcionm" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="descripciónm" name="descripcionm"
                    placeholder="Escriba una descripcion" autofocus>
                </div>
                <button type="button" class="btn w-100" id="enviar">Modificar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar eliminación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Seguro que desea eliminar este proveedor?</p>
        </div>
        <form id="f3" method="post">

          <input class="form-control input-standar" readonly type="text" id="eliminar" name="eliminar"
            placeholder="Introducir ID del proveedor" autofocus>

        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

          <button type="button" class="btn-eliminar" id="confirmDeleteButton">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
</body>



<script src="Assets/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="Assets/js/p_bootstrap.min.js"></script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usuarios</title>

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
      <h1 class="header-standar">Usuarios</h1>
    </div>

    <div class="container-all">
      <div class="container-header">
        <?php
        if (in_array("agregar_usuario", $nivel1)) {
          ?>
          <button class="btn-standar" data-toggle="modal" data-target="#loginModal">Agregar Usuario
            <?php if (isset($mensaje)) {
              echo $mensaje;
            } ?></button>

          <?php
        }
        ?>
      </div>

      <div class="user-table">
        <table class="table table-bordered text-center align-middle" id="tabla">
          <thead>

            <th>N° de empleado</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rol</th>
            <th>CDT de pertenencia</th>

            <th>Modificar</th>
            <th>Eliminar</th>

          </thead>
          <tbody>

            <?php
            if (in_array("consutar_usuario", $nivel1)) {
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
            <div class="col-md-6">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="user">Ingrese el número de empleado</label>
                  <span id="suser" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="user" name="user"
                    placeholder="Introducir n° de empleado" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password">Ingrese nombre del empleado</label>
                  <span id="snombre" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="nombre" name="nombre"
                    placeholder="Escriba su nombre">
                </div>
                <div class="mb-3">
                  <label for="apellido">Ingrese apellido del empleado</label>
                  <span id="sapellido" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="apellido" name="apellido"
                    placeholder="Escriba su apellido">
                </div>
                <div class="mb-3">
                  <label for="user">Ingrese el CDT de pertenencia</label>
                  <span id="scdt" class="text-danger"></span>
                  <select name="cdt" id="cdt" class="form-control input-standar">
                    <?php if (isset($cdt)) {
                      echo $cdt;
                    } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="user">Ingrese el rol del empleado</label>
                  <span id="srol" class="text-danger"></span>
                  <select name="rol" id="rol" class="form-control input-standar">
                    <?php if (isset($roles)) {
                      echo $roles;
                    } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="user">Ingrese el contraseña</label>
                  <span id="scontraseña" class="text-danger"></span>
                  <input class="form-control input-standar" type="text" id="contraseña" name="contraseña"
                    placeholder="Digite su contraseña">
                  <input style="display: none;" type="text" name="accion" value="registrar">
                </div>
                <button type="button" class="btn w-100" id="registrar">Guardar</button>
              </form>
            </div>

          </div>
        </div>
      </div>

      <!-- Modal de modificar -->
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
                <div class="col-md-6">
                  <form id="f2" method="post">
                    <div class="mb-3">
                      <label for="userm">Ingrese el número de empleado</label>
                      <span id="suserm" class="text-danger"></span>
                      <input class="form-control input-standar" readonly type="text" id="userm" name="userm"
                        placeholder="Introducir n° de empleado" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="password">Ingrese nombre del empleado</label>
                      <span id="snombrem" class="text-danger"></span>
                      <input class="form-control input-standar" type="text" id="nombrem" name="nombrem"
                        placeholder="Escrba su nombre">
                    </div>
                    <div class="mb-3">
                      <label for="apellidom">Ingrese apellido del empleado</label>
                      <span id="sapellidom" class="text-danger"></span>
                      <input class="form-control input-standar" type="text" id="apellidom" name="apellidom"
                        placeholder="Escrba su apellido">
                    </div>
                    <div class="mb-3">
                      <label for="cdtm">Ingrese el CDT de pertenencia</label>
                      <span id="scdtm" class="text-danger"></span>
                      <select name="cdtm" id="cdtm" class="form-control input-standar">
                        <?php if (isset($cdt)) {
                          echo $cdt;
                        } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="rolm">Ingrese el rol del empleado</label>
                      <span id="srolm" class="text-danger"></span>
                      <select name="rolm" id="rolm" class ="form-control input-standar">
                        <?php if (isset($roles)) {
                          echo $roles;
                        } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="contraseñam">Ingrese el contraseña</label>
                      <span id="scontraseñam" class="text-danger"></span>
                      <input class="form-control input-standar" type="text" id="contraseñam" name="contraseñam"
                        placeholder="Digite su contraseña">
                      <input style="display: none;" type="text" name="modificar" value="registrar">
                    </div>
                    <button type="button" class="btn w-100" id="modificar">Modificar</button>
                  </form>
                </div>

              </div>
            </div>
          </div>

          <!-- Modal de confirmación (solo front) -->
          <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content" id ="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmar eliminación</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Seguro que desea eliminar este usuario?</p>
                </div>
                <form id="f3" method="post">

                  <input class="form-control input-standar" readonly type="text" id="eliminar" name="eliminar"
                    placeholder="Introducir n° de empleado" autofocus>

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
<script src="Assets/js/usuario.js"></script>

</html>
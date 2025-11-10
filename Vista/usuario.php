<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página Principal</title>

    <link rel="stylesheet" href="assets/css/estilo.css" />
    <link rel="stylesheet" href="assets/css/menu.css" />
    <link rel="stylesheet" href="assets/css/usuarios.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>  
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic:wght@400..700&display=swap" rel="stylesheet">
    <!-- Bootstrap icons and Bootstrap 4 stylesheet (using local Bootstrap 4 JS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
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
        <button class="btn-standar" data-toggle="modal" data-target="#loginModal">Agregar Usuario <?php if(isset($mensaje)) {echo $mensaje; }?></button>
      </div>

      <div class="user-table">
        <table class="table table-bordered text-center align-middle">
          <thead>
            <tr>
              <th>N° de empleado</th>
              <th>Nombre y Apellido</th>
              <th>CDT de pertenencia</th>
              <th>Rol</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>001</td>
              <td>Juan Pérez</td>
              <td>CDT Norte</td>
              <td>Administrador</td>
              <td><button class="btn-modificar btn-sm">Modificar</button></td>
              <td><button class="btn-eliminar btn-sm">Eliminar</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal de Agregar -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg"> <!-- modal grande -->
        <div class="modal-content" id="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row align-items-center">
              <!-- Columna del formulario -->
              <div class="col-md-6">
                <form id="f" method="post">
                  <div class="mb-3">
                    <label for="user">Ingrese el número de empleado</label>
                    <span id="suser" class="text-danger"></span>
                    <input class="form-control input-standar" type="text" id="user" name="user" placeholder="Introducir n° de empleado" autofocus>
                  </div>
                  <div class="mb-3">
                    <label for="password">Ingrese nombre del empleado</label>
                    <span id="snombre" class="text-danger"></span>
                    <input class="form-control input-standar" type="text" id="nombre" name="nombre" placeholder="Escrba su nombre">
                  </div>
                  <div class="mb-3">
                    <label for="apellido">Ingrese apellido del empleado</label>
                    <span id="sapellido" class="text-danger"></span>
                    <input class="form-control input-standar" type="text" id="apellido" name="apellido" placeholder="Escrba su apellido">
                  </div>
                  <div class="mb-3">
                    <label for="user">Ingrese el CDT de pertenencia</label>
                    <span id="scdt" class="text-danger"></span>
                    <select name="cdt" id="cdt">
                      <?php if(isset($cdt)) {echo $cdt; } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="user">Ingrese el rol del empleado</label>
                    <span id="srol" class="text-danger"></span>
                    <select name="rol" id="rol">
                      <?php if(isset($roles)) {echo $roles; } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="user">Ingrese el contraseña</label>
                    <span id="scontraseña" class="text-danger"></span>
                    <input class="form-control input-standar" type="text" id="contraseña" name="contraseña" placeholder="Digite su contraseña">
                    <input  type="text" name="accion" value="registrar">
                  </div>
                  <button type="button" class="btn w-100" id="registrar">guardar</button>
                </form>
              </div>

              <!-- Columna de la imagen -->
              <div class="col-md-6 text-center">
                <img src="assets/Imagenes/F-Login.png" alt="Login Image" class="img-fluid rounded">
              </div>
            </div>
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
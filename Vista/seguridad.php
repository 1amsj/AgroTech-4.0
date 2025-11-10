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
            <h1 class="header-standar">Seguridad</h1>
        </div>

        <div class="container-all">
            <div class="container-header" style="display: flex; justify-content: center; align-items: center; ">
                <h1 class="title" style = "font-size: 3vh;" >Gestión de Roles</h1>
                <button class="btn-standar" data-toggle="modal" data-target="#loginModal">Registrar</button>
            </div>

            <div class="user-table">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Super Administrador</td>
                            <td>Juan Pérez</td>
                            <td><button class="btn-modificar btn-sm" data-toggle="modal"
                                    data-target="#ModificarModal">Modificar</button>
                                <button class="btn-eliminar btn-sm" data-toggle="modal"
                                    data-target="#SetModal">Asignar</button>
                            </td>
                        </tr>
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
                                    <label for="user">Nombre del rol</label>
                                    <input class="form-control input-standar" type="text" id="user" name="user"
                                        placeholder="Introducir n° de empleado" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Descripción</label>
                                    <input class="form-control input-standar" type="password" id="password"
                                        name="password" placeholder="Digite su contraseña">
                                </div>
                                <button type="submit" class="btn w-100" id="enviar">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal de Editar -->

    <div class="modal fade" id="ModificarModal" tabindex="-1" aria-hidden="true">
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
                                    <label for="user">Nombre del rol</label>
                                    <input class="form-control input-standar" type="text" id="user" name="user"
                                        placeholder="Introducir n° de empleado" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Descripción</label>
                                    <input class="form-control input-standar" id="password"
                                        name="password" placeholder="Digite su contraseña">
                                </div>
                                <button type="submit" class="btn w-100" id="enviar">Modificar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="SetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-center align-items-center text-center">
                        <!-- Columna del formulario -->
                        <div class="col-md-8">
                            <form id="f" method="post">
                                <div style="display: flex; justify-content: center; align-items: center; ">
                                    <div class="mb-3">
                                        <button class="enviar">Marcar todos</button>
                                    </div>
                                    <div class="mb-3">
                                        <button class="enviar">Desmarcar todos</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn w-100" id="enviar">Asignar</button>
                            </form>
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

</html>
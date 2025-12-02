<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seguridad</title>

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
                    <tbody id="table">
                        <tr>
                            <?php if(!empty($consuta)){echo $consuta;} ?>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered text-center align-middle" id="permisos" style="display:none;">
                    <thead>
                        <tr>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tablaP">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>
 <form id="fP" method="post">
     <input type="text" id="id_rol" name="id_rol" value="">
    </form>
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
                            <form id="f1" method="post">
                                <div class="mb-3">
                                    <label for="user">Nombre del rol</label>
                                    <input class="form-control input-standar" type="text" id="rol" name="rol"
                                        placeholder="Introducir nombre del rol" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Descripción</label>
                                    <input class="form-control input-standar" type="text" id="descripcion"
                                        name="descripcion" placeholder="Digite su descripción">
                                </div>
                                <button type="button" class="btn w-100" id="enviar1">Registrar</button>
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
                            <form id="f2" method="post">
                                <div class="mb-3">
                                    <label for="user">Nombre del rol</label>
                                    <input class="form-control input-standar" type="text" id="rol1" name="rol1"
                                        placeholder="Introducir nombre del rol" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Descripción</label>
                                    <input class="form-control input-standar" id="descripcion1"
                                        name="descripcion1" placeholder="Digite su descripción">
                                </div>
                                <button type="button" class="btn w-100" id="modificar">Modificar</button>
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
                    <h5 class="modal-title">Asignar permisos a <span id="nombreRol"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-center align-items-center text-center">
                        <!-- Columna del formulario -->
                        <div class="col-md-8">
                            <form id="fpp" method="post">
                                <div style="display: flex; justify-content: center; align-items: center; ">
                                    <div class="mb-3">
                                        <button type="button" class="enviar" id="selectAllPerms">Marcar todos</button>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="enviar" id="clearAllPerms">Desmarcar todos</button>
                                    </div>
                                </div>

                                <div class="container-fluid permisos-grid text-left mb-3">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <h6 class="text-uppercase">Usuario</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="1" name="exampleRadios[]" value="1">
                                                <label class="custom-control-label" for="1">Registrar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="2" name="exampleRadios[]" value="2">
                                                <label class="custom-control-label" for="2">Modificar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="3" name="exampleRadios[]" value="3">
                                                <label class="custom-control-label" for="3">Eliminar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="4" name="exampleRadios[]" value="4">
                                                <label class="custom-control-label" for="4">Consultar</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <h6 class="text-uppercase">Seguridad</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="23" name="exampleRadios[]" value="23">
                                                <label class="custom-control-label" for="23">Registrar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="24" name="exampleRadios[]" value="24">
                                                <label class="custom-control-label" for="24">Modificar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="25" name="exampleRadios[]" value="25">
                                                <label class="custom-control-label" for="25">Eliminar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="26" name="exampleRadios[]" value="26">
                                                <label class="custom-control-label" for="26">Consultar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="72" name="exampleRadios[]" value="72">
                                                <label class="custom-control-label" for="72">Permisos Seguridad</label>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <h6 class="text-uppercase">Destinatario</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="29" name="exampleRadios[]" value="29">
                                                <label class="custom-control-label" for="29">Registrar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="30" name="exampleRadios[]" value="30">
                                                <label class="custom-control-label" for="30">Modificar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="31" name="exampleRadios[]" value="31">
                                                <label class="custom-control-label" for="31">Eliminar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="62" name="exampleRadios[]" value="62">
                                                <label class="custom-control-label" for="62">Consultar</label>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <h6 class="text-uppercase">Proveedores</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="63" name="exampleRadios[]" value="63">
                                                <label class="custom-control-label" for="63">Registrar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="64" name="exampleRadios[]" value="64">
                                                <label class="custom-control-label" for="64">Modificar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="65" name="exampleRadios[]" value="65">
                                                <label class="custom-control-label" for="65">Eliminar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="66" name="exampleRadios[]" value="66">
                                                <label class="custom-control-label" for="66">Consultar</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <h6 class="text-uppercase">Reportes</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="27" name="exampleRadios[]" value="27">
                                                <label class="custom-control-label" for="27">reporte 1</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="75" name="exampleRadios[]" value="75">
                                                <label class="custom-control-label" for="75">reporte 1</label>
                                            </div>
                                            
                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <h6 class="text-uppercase">Bitacora</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="5" name="exampleRadios[]" value="5">
                                                <label class="custom-control-label" for="5">Consulta</label>
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <h6 class="text-uppercase">Inventario</h6>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="6" name="exampleRadios[]" value="6">
                                                <label class="custom-control-label" for="6">Registrar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="7" name="exampleRadios[]" value="7">
                                                <label class="custom-control-label" for="7">Modificar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="8" name="exampleRadios[]" value="8">
                                                <label class="custom-control-label" for="8">Eliminar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="9" name="exampleRadios[]" value="9">
                                                <label class="custom-control-label" for="9">Consultar</label>
                                            </div>
                                        </div>
                                        
                                    
                                        
                                    </div>

                                    
                                    
                                </div>
                                <input type="text" style="display: none;" id="id2" name="id2" value="" >
                                <button type="button" class="btn w-100" id="enviarp">Asignar</button>
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
<script src="Assets/js/seguridad.js"></script>
</html>
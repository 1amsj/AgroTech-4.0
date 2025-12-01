<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inventario</title>

  <link rel="stylesheet" href="assets/css/estilo.css" />
  <link rel="stylesheet" href="assets/css/menu.css" />
  <link rel="stylesheet" href="assets/css/usuarios.css" />
  <link rel="stylesheet" href="assets/css/cards.css" />
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
      <h1 class="header-standar">Inventario</h1>
    </div>

    <div class="container-all">
      <div class="container-header">
        <?php if (is_array($nivel1) && in_array("agregar_inventario", $nivel1, true)) : ?>
        <button class="btn-standar" data-toggle="modal" data-target="#createInventoryModal">Agregar Producto</button>
        <?php endif; ?>
      </div>
      <div class="container-cards">
        <div class="ag-courses_box">
          <?php
              if (in_array("consultar_inventario", $nivel1)) {
                if (isset($consult)) {
                  echo $consult;
                }
              }
              ?>
        </div>
      </div>
    </div>
  </main>

  <?php require_once("comunes/detalle_inventario.php"); ?>

  <div class="modal fade" id="createInventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="inventoryCreateForm" method="post">
                <input type="hidden" name="accion" value="registrar">
                <div class="mb-3">
                  <label for="createProductName">Nombre del producto</label>
                  <input class="form-control input-standar" type="text" id="createProductName" name="nombre"
                    placeholder="Escriba el nombre del producto" autofocus>
                </div>
                <div class="mb-3">
                  <label for="createProductCategory">Categoría</label>
                  <input class="form-control input-standar" type="text" id="createProductCategory" name="categoria"
                    placeholder="Escriba la categoría del producto">
                  </div>
                <div class="mb-3">
                  <label for="createProductDate">Fecha</label>
                  <input class="form-control input-standar" type="date" id="createProductDate" name="fecha"
                    placeholder="Seleccione la fecha">
                  </div>
                <div class="mb-3">
                  <label for="createProductStock">Stock Actual</label>
                  <input class="form-control input-standar" type="number" min="0" step="0.01" id="createProductStock" name="stocka"
                    placeholder="Escriba el stock actual">
                </div>
                <div class="mb-3">
                  <label for="createProductPrice">Costo unitario</label>
                  <input class="form-control input-standar" type="number" min="0" step="0.01" id="createProductPrice" name="precio"
                    placeholder="Ingrese el costo unitario">
                </div>
                <div class ="mb-3">
                  <label for="createProductProvider">Proveedor</label>
                  <span id="providerCreateError" class="text-danger"></span>
                  <select name="proveedor" id="createProductProvider" class="form-control input-standar">
                    <option value="">Seleccione un proveedor</option>
                    <?php if (!empty($proveedoresInventario)) : ?>
                      <?php foreach ($proveedoresInventario as $proveedor) : ?>
                        <option value="<?php echo htmlspecialchars($proveedor['id'], ENT_QUOTES, 'UTF-8'); ?>">
                          <?php echo htmlspecialchars($proveedor['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <button type="button" class="btn w-100" id="submitCreateInventory">Enviar</button>
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
<script src="Assets/js/inventario.js"></script>

</html>
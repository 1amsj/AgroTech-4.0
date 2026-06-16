<?php
if (!function_exists('agrotech_reportes_format')) {
    function agrotech_reportes_format($valor, $decimales = 2)
    {
        $texto = trim((string) $valor);
        if ($texto === '') {
            return '0.00';
        }

        $limpio = str_replace(['$', ',', ' '], '', $texto);
        if (!is_numeric($limpio)) {
            return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
        }

        return number_format((float) $limpio, $decimales, '.', ',');
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reportes</title>

  <link rel="stylesheet" href="assets/css/estilo.css" />
  <link rel="stylesheet" href="assets/css/menu.css" />
  <link rel="stylesheet" href="assets/css/usuarios.css" />
  <link rel="stylesheet" href="assets/css/reportes.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Special+Gothic:wght@400..700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <nav class="sidebar">
    <?php require_once("comunes/menu.php"); ?>
  </nav>

  <main class="main-content">
    <div class="header">
      <h1 class="header-standar">Reportes</h1>
      <span class="Parrafo">Consulta y genera reportes PDF de los movimientos del inventario.</span>
    </div>

    <div class="container-all">
      <?php if ($puedeConsultar) : ?>
        <section class="reportes-filtros">
          <h2>Filtros de busqueda</h2>
          <form method="post" id="formFiltros">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($filtros['fecha_inicio'], ENT_QUOTES, 'UTF-8'); ?>">
              </div>
              <div class="form-group col-md-3">
                <label for="fecha_fin">Fecha fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($filtros['fecha_fin'], ENT_QUOTES, 'UTF-8'); ?>">
              </div>
              <div class="form-group col-md-3">
                <label for="tipo">Tipo de movimiento</label>
                <select class="form-control" id="tipo" name="tipo">
                  <option value="">Todos</option>
                  <?php foreach ($tiposDisponibles as $tipoDisponible) : ?>
                    <option value="<?php echo htmlspecialchars($tipoDisponible, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $filtros['tipo'] === $tipoDisponible ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($tipoDisponible, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="usuario">Responsable</label>
                <select class="form-control" id="usuario" name="usuario">
                  <option value="">Todos</option>
                  <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?php echo htmlspecialchars($usuario['id'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo $filtros['usuario'] === $usuario['id'] ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="producto">Producto</label>
                <select class="form-control" id="producto" name="producto">
                  <option value="">Todos</option>
                  <?php foreach ($productos as $producto) : ?>
                    <option value="<?php echo htmlspecialchars($producto['id'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo $filtros['producto'] === $producto['id'] ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="reportes-actions">
              <button type="submit" name="filtrar" value="1" class="reportes-btn reportes-btn-primary">
                <i class="bi bi-funnel mr-2"></i>Aplicar filtros
              </button>
              <a href="?pagina=reportes" class="reportes-btn reportes-btn-secondary">
                <i class="bi bi-arrow-counterclockwise mr-2"></i>Limpiar filtros
              </a>
              <?php if (in_array('generar_reportes', $permisosSesion, true)) : ?>
                <button type="submit" name="generar_pdf" value="1" class="reportes-btn reportes-btn-outline" formtarget="_blank">
                  <i class="bi bi-file-earmark-pdf mr-2"></i>Generar PDF
                </button>
              <?php endif; ?>
            </div>
          </form>
        </section>

        <section class="reportes-resumen">
          <div class="resumen-card">
            <h3>Movimientos</h3>
            <p><?php echo number_format($resumen['total_registros']); ?></p>
            <span>Total de registros encontrados</span>
          </div>
          <div class="resumen-card">
            <h3>Unidades</h3>
            <p><?php echo number_format($resumen['total_unidades'], 2, '.', ','); ?></p>
            <span>Cantidad total movilizada</span>
          </div>
          <div class="resumen-card ingresos">
            <h3>Entradas ($)</h3>
            <p><?php echo number_format($resumen['total_entradas'], 2, '.', ','); ?></p>
            <span>Valor de entradas</span>
          </div>
          <div class="resumen-card egresos">
            <h3>Salidas ($)</h3>
            <p><?php echo number_format($resumen['total_salidas'], 2, '.', ','); ?></p>
            <span>Valor de salidas</span>
          </div>
          <div class="resumen-card balance">
            <h3>Balance ($)</h3>
            <p><?php echo number_format($resumen['balance'], 2, '.', ','); ?></p>
            <span>Diferencia entre entradas y salidas</span>
          </div>
        </section>

        <section class="reportes-table-container">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Movimientos registrados</h2>
            <small class="text-muted">Filtros activos: <?php echo htmlspecialchars($etiquetasSeleccion['fecha_inicio'], ENT_QUOTES, 'UTF-8'); ?> a <?php echo htmlspecialchars($etiquetasSeleccion['fecha_fin'], ENT_QUOTES, 'UTF-8'); ?> | Tipo: <?php echo htmlspecialchars($etiquetasSeleccion['tipo'], ENT_QUOTES, 'UTF-8'); ?> | Responsable: <?php echo htmlspecialchars($etiquetasSeleccion['usuario'], ENT_QUOTES, 'UTF-8'); ?> | Producto: <?php echo htmlspecialchars($etiquetasSeleccion['producto'], ENT_QUOTES, 'UTF-8'); ?></small>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Producto</th>
                  <th>Tipo</th>
                  <th>Cantidad</th>
                  <th>Costo unitario</th>
                  <th>Costo total</th>
                  <th>Stock resultante</th>
                  <th>Responsable</th>
                  <th>Motivo</th>
                  <th>Destinatarios</th>
                  <th>Proveedores</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($movimientos)) : ?>
                  <tr>
                    <td colspan="12">No se encontraron movimientos con los filtros seleccionados.</td>
                  </tr>
                <?php else : ?>
                  <?php foreach ($movimientos as $indice => $movimiento) : ?>
                    <tr>
                      <td><?php echo (int) ($indice + 1); ?></td>
                      <td><?php echo htmlspecialchars($movimiento['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($movimiento['producto'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($movimiento['tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo agrotech_reportes_format($movimiento['cantidad']); ?></td>
                      <td><?php echo agrotech_reportes_format($movimiento['costo_unitario']); ?></td>
                      <td><?php echo agrotech_reportes_format($movimiento['costo_total']); ?></td>
                      <td><?php echo htmlspecialchars($movimiento['stock_resultante'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($movimiento['usuario'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($movimiento['motivo'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo $movimiento['destinatarios'] !== '' ? htmlspecialchars($movimiento['destinatarios'], ENT_QUOTES, 'UTF-8') : '--'; ?></td>
                      <td><?php echo $movimiento['proveedores'] !== '' ? htmlspecialchars($movimiento['proveedores'], ENT_QUOTES, 'UTF-8') : '--'; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>
      <?php else : ?>
        <div class="alert alert-warning mt-4" role="alert">
          No tiene permisos para consultar los reportes.
        </div>
      <?php endif; ?>
    </div>
  </main>

  <script src="Assets/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="Assets/js/p_bootstrap.min.js"></script>
</body>

</html>

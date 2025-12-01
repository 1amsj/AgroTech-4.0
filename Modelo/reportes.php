<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once('modelo/conexion.php');

$dompdfAutoload = __DIR__ . '/../dompdf/vendor/autoload.php';
if (!is_file($dompdfAutoload)) {
    throw new RuntimeException('No se encontró el autoloader de Dompdf en ' . $dompdfAutoload);
}
require_once $dompdfAutoload;

class reportes extends datos
{
    public function obtenerTiposMovimiento(): array
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT DISTINCT tipo FROM movimiento WHERE tipo IS NOT NULL AND tipo <> '' ORDER BY tipo ASC";
        $stmt = $co->prepare($sql);
        $stmt->execute();

        $tipos = [];
        foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $tipo) {
            $tipos[] = (string) $tipo;
        }

        return $tipos;
    }

    public function obtenerUsuarios(): array
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT N_de_empleado AS id, CONCAT(Nombre, ' ', Apellido) AS nombre, Estado FROM usuario ORDER BY nombre ASC";
        $stmt = $co->prepare($sql);
        $stmt->execute();

        $usuarios = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if (isset($row['Estado']) && trim((string) $row['Estado']) !== '1') {
                continue;
            }

            $usuarios[] = [
                'id' => (string) $row['id'],
                'nombre' => trim((string) $row['nombre']) !== '' ? (string) $row['nombre'] : (string) $row['id']
            ];
        }

        return $usuarios;
    }

    public function obtenerProductos(): array
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT ID AS id, Nombre AS nombre, Estado FROM inventario ORDER BY nombre ASC";
        $stmt = $co->prepare($sql);
        $stmt->execute();

        $productos = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if (isset($row['Estado']) && (int) $row['Estado'] !== 1) {
                continue;
            }

            $productos[] = [
                'id' => (string) $row['id'],
                'nombre' => trim((string) $row['nombre'])
            ];
        }

        return $productos;
    }

    public function obtenerMovimientos(array $filtros = []): array
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT
                    m.id,
                    i.Nombre AS producto,
                    m.tipo,
                    m.cantidad,
                    m.motivo,
                    m.costo_unitario,
                    m.costo_total,
                    m.stock_resultante,
                    m.fecha,
                    CONCAT(u.Nombre, ' ', u.Apellido) AS usuario,
                    GROUP_CONCAT(DISTINCT CONCAT(d.Nombre, ' ', d.Apellido) SEPARATOR ', ') AS destinatarios,
                    GROUP_CONCAT(DISTINCT CONCAT(p.Nombre, ' ', p.Apellido) SEPARATOR ', ') AS proveedores
                FROM movimiento m
                INNER JOIN inventario i ON i.ID = m.id_inventario
                INNER JOIN usuario u ON u.N_de_empleado = m.id_usuario
                LEFT JOIN movimiento_destinatario md ON md.id_movimiento = m.id
                LEFT JOIN destinatario d ON d.ID = md.id_destinatario
                LEFT JOIN movimiento_proveedor mp ON mp.id_movimiento = m.id
                LEFT JOIN proveedor p ON p.ID = mp.id_proveedor
                WHERE 1 = 1";

        $params = [];

        if (!empty($filtros['fecha_inicio'])) {
            $sql .= " AND STR_TO_DATE(m.fecha, '%Y-%m-%d') >= STR_TO_DATE(:fecha_inicio, '%Y-%m-%d')";
            $params[':fecha_inicio'] = $filtros['fecha_inicio'];
        }

        if (!empty($filtros['fecha_fin'])) {
            $sql .= " AND STR_TO_DATE(m.fecha, '%Y-%m-%d') <= STR_TO_DATE(:fecha_fin, '%Y-%m-%d')";
            $params[':fecha_fin'] = $filtros['fecha_fin'];
        }

        if (!empty($filtros['tipo'])) {
            $sql .= " AND m.tipo = :tipo";
            $params[':tipo'] = $filtros['tipo'];
        }

        if (!empty($filtros['usuario'])) {
            $sql .= " AND m.id_usuario = :usuario";
            $params[':usuario'] = $filtros['usuario'];
        }

        if (!empty($filtros['producto'])) {
            $sql .= " AND m.id_inventario = :producto";
            $params[':producto'] = $filtros['producto'];
        }

        $sql .= " GROUP BY
                    m.id,
                    i.Nombre,
                    m.tipo,
                    m.cantidad,
                    m.motivo,
                    m.costo_unitario,
                    m.costo_total,
                    m.stock_resultante,
                    m.fecha,
                    usuario
                ORDER BY
                    STR_TO_DATE(m.fecha, '%Y-%m-%d') DESC,
                    m.id DESC";

        $stmt = $co->prepare($sql);
        foreach ($params as $clave => $valor) {
            $stmt->bindValue($clave, $valor);
        }

        $stmt->execute();

        $movimientos = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $movimientos[] = [
                'id' => (int) $row['id'],
                'producto' => (string) $row['producto'],
                'tipo' => (string) $row['tipo'],
                'cantidad' => (string) $row['cantidad'],
                'motivo' => (string) $row['motivo'],
                'costo_unitario' => (string) $row['costo_unitario'],
                'costo_total' => (string) $row['costo_total'],
                'stock_resultante' => (string) $row['stock_resultante'],
                'fecha' => (string) $row['fecha'],
                'usuario' => (string) $row['usuario'],
                'destinatarios' => $row['destinatarios'] !== null ? (string) $row['destinatarios'] : '',
                'proveedores' => $row['proveedores'] !== null ? (string) $row['proveedores'] : ''
            ];
        }

        return $movimientos;
    }

    public function calcularResumen(array $movimientos): array
    {
        $totalRegistros = count($movimientos);
        $totalUnidades = 0.0;
        $totalEntradas = 0.0;
        $totalSalidas = 0.0;

        foreach ($movimientos as $movimiento) {
            $cantidad = $this->normalizarNumero($movimiento['cantidad']);
            $total = $this->normalizarNumero($movimiento['costo_total']);
            $tipo = strtolower(trim((string) $movimiento['tipo']));

            $totalUnidades += $cantidad;

            if ($tipo === 'entrada') {
                $totalEntradas += $total;
            } elseif ($tipo === 'salida') {
                $totalSalidas += $total;
            } else {
                if ($total >= 0) {
                    $totalEntradas += $total;
                } else {
                    $totalSalidas += abs($total);
                }
            }
        }

        return [
            'total_registros' => $totalRegistros,
            'total_unidades' => $totalUnidades,
            'total_entradas' => $totalEntradas,
            'total_salidas' => $totalSalidas,
            'balance' => $totalEntradas - $totalSalidas,
        ];
    }

    public function generarPdf(array $filtros, array $etiquetasFiltros, string $usuarioSesion): void
    {
        if ($usuarioSesion !== '' && ctype_digit((string) $usuarioSesion)) {
            try {
                $this->registrar_bitacora('Generacion de reporte PDF', 'reportes', $usuarioSesion);
            } catch (Exception $e) {
                // Ignorar errores de bitacora para no interrumpir la descarga
            }
        }

        $movimientos = $this->obtenerMovimientos($filtros);
        $resumen = $this->calcularResumen($movimientos);

        $fechaActual = date('Y-m-d H:i');
        $titulo = 'Reporte de movimientos de inventario';

        ob_start();
        ?>
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #202124; }
                h1 { text-align: center; font-size: 18px; margin-bottom: 6px; }
                .metadata { text-align: center; font-size: 11px; margin-bottom: 16px; }
                .metadata span { display: block; }
                .filters { margin-bottom: 18px; }
                .filters h2 { font-size: 13px; margin-bottom: 6px; }
                .filters ul { list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 12px; }
                .filters li { background: #f1f3f4; padding: 6px 10px; border-radius: 8px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #d0d0d0; padding: 6px; text-align: left; }
                th { background: #081c15; color: #ffffff; font-size: 11px; }
                tbody tr:nth-child(even) { background: #f9f9f9; }
                .summary { margin-top: 18px; display: flex; gap: 16px; }
                .summary div { flex: 1; background: #f1f3f4; padding: 10px; border-radius: 8px; text-align: center; }
                .summary h3 { margin: 0 0 6px 0; font-size: 13px; text-transform: uppercase; }
                .summary p { margin: 0; font-size: 16px; font-weight: bold; }
            </style>
        </head>
        <body>
            <h1><?php echo htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'); ?></h1>
            <div class="metadata">
                <span>Generado por: <?php echo htmlspecialchars($usuarioSesion, ENT_QUOTES, 'UTF-8'); ?></span>
                <span>Fecha de generacion: <?php echo htmlspecialchars($fechaActual, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <div class="filters">
                <h2>Filtros aplicados</h2>
                <ul>
                    <li>Fecha inicio: <?php echo htmlspecialchars($etiquetasFiltros['fecha_inicio'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li>Fecha fin: <?php echo htmlspecialchars($etiquetasFiltros['fecha_fin'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li>Tipo: <?php echo htmlspecialchars($etiquetasFiltros['tipo'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li>Usuario: <?php echo htmlspecialchars($etiquetasFiltros['usuario'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li>Producto: <?php echo htmlspecialchars($etiquetasFiltros['producto'], ENT_QUOTES, 'UTF-8'); ?></li>
                </ul>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Motivo</th>
                        <th>Costo unitario</th>
                        <th>Costo total</th>
                        <th>Stock resultante</th>
                        <th>Responsable</th>
                        <th>Destinatarios</th>
                        <th>Proveedores</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($movimientos)) : ?>
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 20px;">No se encontraron movimientos para los filtros seleccionados.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($movimientos as $index => $movimiento) : ?>
                        <tr>
                            <td><?php echo (int) ($index + 1); ?></td>
                            <td><?php echo htmlspecialchars($movimiento['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($movimiento['producto'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($movimiento['tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $this->formatearNumeroParaPdf($movimiento['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($movimiento['motivo'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $this->formatearNumeroParaPdf($movimiento['costo_unitario']); ?></td>
                            <td><?php echo $this->formatearNumeroParaPdf($movimiento['costo_total']); ?></td>
                            <td><?php echo htmlspecialchars($movimiento['stock_resultante'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($movimiento['usuario'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $movimiento['destinatarios'] !== '' ? htmlspecialchars($movimiento['destinatarios'], ENT_QUOTES, 'UTF-8') : '--'; ?></td>
                            <td><?php echo $movimiento['proveedores'] !== '' ? htmlspecialchars($movimiento['proveedores'], ENT_QUOTES, 'UTF-8') : '--'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <div class="summary">
                <div>
                    <h3>Movimientos</h3>
                    <p><?php echo number_format($resumen['total_registros']); ?></p>
                </div>
                <div>
                    <h3>Unidades totales</h3>
                    <p><?php echo number_format($resumen['total_unidades'], 2, '.', ','); ?></p>
                </div>
                <div>
                    <h3>Entradas ($)</h3>
                    <p><?php echo number_format($resumen['total_entradas'], 2, '.', ','); ?></p>
                </div>
                <div>
                    <h3>Salidas ($)</h3>
                    <p><?php echo number_format($resumen['total_salidas'], 2, '.', ','); ?></p>
                </div>
                <div>
                    <h3>Balance ($)</h3>
                    <p><?php echo number_format($resumen['balance'], 2, '.', ','); ?></p>
                </div>
            </div>
        </body>
        </html>
        <?php
        $html = ob_get_clean();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('letter', 'landscape');
        $dompdf->render();

        $nombreArchivo = 'reporte_movimientos_' . date('Ymd_His') . '.pdf';
        $dompdf->stream($nombreArchivo, ['Attachment' => false]);
        exit;
    }

    private function normalizarNumero($valor): float
    {
        $texto = trim((string) $valor);
        if ($texto === '') {
            return 0.0;
        }

        $limpio = str_replace(['$', ',', ' '], '', $texto);

        if (!is_numeric($limpio)) {
            return 0.0;
        }

        return (float) $limpio;
    }

    private function formatearNumeroParaPdf($valor, int $decimales = 2): string
    {
        $texto = trim((string) $valor);
        if ($texto === '') {
            return number_format(0, $decimales, '.', ',');
        }

        $limpio = str_replace(['$', ',', ' '], '', $texto);

        if (!is_numeric($limpio)) {
            return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
        }

        return number_format((float) $limpio, $decimales, '.', ',');
    }
}

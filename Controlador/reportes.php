<?php 

if (!is_file("modelo/".$pagina.".php")){
    echo "Falta definir la clase ".$pagina;
    exit;
}
require_once("modelo/".$pagina.".php"); 

if(is_file("vista/".$pagina.".php")){
    if(empty($_SESSION)){
        session_start();
    }

    $usuarioSesion = $_SESSION['usuario'] ?? "";
    $permisosSesion = $_SESSION['permisos'] ?? [];
    if (!is_array($permisosSesion)) {
        $permisosSesion = [];
    }

    $o = new reportes();

    $tiposDisponibles = $o->obtenerTiposMovimiento();
    $usuarios = $o->obtenerUsuarios();
    $productos = $o->obtenerProductos();

    $mapUsuarios = [];
    foreach ($usuarios as $usuario) {
        $mapUsuarios[$usuario['id']] = $usuario['nombre'];
    }

    $mapProductos = [];
    foreach ($productos as $producto) {
        $mapProductos[$producto['id']] = $producto['nombre'];
    }

    $filtros = [
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'tipo' => '',
        'usuario' => '',
        'producto' => ''
    ];

    if(!empty($_POST)){
        $fechaInicio = isset($_POST['fecha_inicio']) ? trim($_POST['fecha_inicio']) : '';
        if ($fechaInicio !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaInicio)) {
            $filtros['fecha_inicio'] = $fechaInicio;
        }

        $fechaFin = isset($_POST['fecha_fin']) ? trim($_POST['fecha_fin']) : '';
        if ($fechaFin !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaFin)) {
            $filtros['fecha_fin'] = $fechaFin;
        }

        $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : '';
        if ($tipo !== '' && in_array($tipo, $tiposDisponibles, true)) {
            $filtros['tipo'] = $tipo;
        }

        $usuarioSeleccionado = isset($_POST['usuario']) ? trim((string) $_POST['usuario']) : '';
        if ($usuarioSeleccionado !== '' && isset($mapUsuarios[$usuarioSeleccionado])) {
            $filtros['usuario'] = $usuarioSeleccionado;
        }

        $productoSeleccionado = isset($_POST['producto']) ? trim((string) $_POST['producto']) : '';
        if ($productoSeleccionado !== '' && isset($mapProductos[$productoSeleccionado])) {
            $filtros['producto'] = $productoSeleccionado;
        }

        if (!empty($_POST['generar_pdf'])) {
            if (!in_array('generar_reportes', $permisosSesion, true)) {
                echo "No tiene permisos para generar reportes.";
                exit;
            }

            $etiquetas = [
                'fecha_inicio' => $filtros['fecha_inicio'] !== '' ? $filtros['fecha_inicio'] : 'Sin definir',
                'fecha_fin' => $filtros['fecha_fin'] !== '' ? $filtros['fecha_fin'] : 'Sin definir',
                'tipo' => $filtros['tipo'] !== '' ? $filtros['tipo'] : 'Todos',
                'usuario' => ($filtros['usuario'] !== '' && isset($mapUsuarios[$filtros['usuario']])) ? $mapUsuarios[$filtros['usuario']] : 'Todos',
                'producto' => ($filtros['producto'] !== '' && isset($mapProductos[$filtros['producto']])) ? $mapProductos[$filtros['producto']] : 'Todos'
            ];

            $o->generarPdf($filtros, $etiquetas, $usuarioSesion);
        }
    }

    $puedeConsultar = in_array('consultar_reportes', $permisosSesion, true);

    if ($puedeConsultar) {
        $movimientos = $o->obtenerMovimientos($filtros);
        $resumen = $o->calcularResumen($movimientos);
    } else {
        $movimientos = [];
        $resumen = [
            'total_registros' => 0,
            'total_unidades' => 0,
            'total_entradas' => 0,
            'total_salidas' => 0,
            'balance' => 0,
        ];
    }

    $etiquetasSeleccion = [
        'fecha_inicio' => $filtros['fecha_inicio'] !== '' ? $filtros['fecha_inicio'] : 'Sin definir',
        'fecha_fin' => $filtros['fecha_fin'] !== '' ? $filtros['fecha_fin'] : 'Sin definir',
        'tipo' => $filtros['tipo'] !== '' ? $filtros['tipo'] : 'Todos',
        'usuario' => ($filtros['usuario'] !== '' && isset($mapUsuarios[$filtros['usuario']])) ? $mapUsuarios[$filtros['usuario']] : 'Todos',
        'producto' => ($filtros['producto'] !== '' && isset($mapProductos[$filtros['producto']])) ? $mapProductos[$filtros['producto']] : 'Todos'
    ];

    require_once("vista/".$pagina.".php");
}
else{
    echo "PAGINA EN CONSTRUCCION";
}

?>

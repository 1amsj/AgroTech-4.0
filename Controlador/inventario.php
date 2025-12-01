<?php 
if (!is_file("modelo/".$pagina.".php")){
	echo "Falta definir la clase " . $pagina;
	exit;
}
require_once("modelo/".$pagina.".php");

if (is_file("vista/".$pagina.".php")) {
	if (empty($_SESSION)) {
		session_start();
	}

	$nivel = $_SESSION['usuario'] ?? '';
	$nivel1 = $_SESSION['permisos'] ?? [];
	if (!is_array($nivel1)) {
		$nivel1 = [];
	}

	$o = new Inventario();

	if (!empty($_POST)) {
		if (!empty($_POST['accion']) && $_POST['accion'] === 'registrar') {
			$o->set_nombre($_POST['nombre'] ?? '');
			$o->set_categoria($_POST['categoria'] ?? '');
			$o->set_fecha($_POST['fecha'] ?? '');
			$o->set_stocka($_POST['stocka'] ?? '0');
			$o->set_precio($_POST['precio'] ?? '0');
			$o->set_proveedor($_POST['proveedor'] ?? '');
			$o->set_nivel($nivel);
			echo $o->registrar();
		}

		if (!empty($_POST['modificar'])) {
			$o->set_id($_POST['modificar']);
			$o->set_nombre($_POST['nombrem'] ?? '');
			$o->set_categoria($_POST['categoriam'] ?? '');
			$o->set_fecha($_POST['fecham'] ?? '');
			$o->set_stocka($_POST['stockam'] ?? '0');
			$o->set_precio($_POST['preciom'] ?? '0');
			$o->set_nivel($nivel);
			echo $o->modificar();
		}

		if (!empty($_POST['eliminar'])) {
			$o->set_id($_POST['eliminar']);
			$o->set_nivel($nivel);
			echo $o->eliminar();
		}

		if (!empty($_POST['entrada'])) {
			$datosEntrada = [
				'id_inventario' => $_POST['entrada'],
				'cantidad' => $_POST['cantidad_entrada'] ?? '0',
				'fecha' => $_POST['fecha_entrada'] ?? '',
				'usuario' => $nivel,
				'relacion_id' => $_POST['proveedor_entrada'] ?? 0,
				'motivo' => 'Entrada registrada desde el modulo de inventario',
				'costo_unitario' => $_POST['costo_unitario_entrada'] ?? null,
				'costo_total' => $_POST['costo_total_entrada'] ?? null
			];
			echo $o->registrarEntradaInventario($datosEntrada);
		}

		if (!empty($_POST['salida'])) {
			$datosSalida = [
				'id_inventario' => $_POST['salida'],
				'cantidad' => $_POST['cantidad_salida'] ?? '0',
				'fecha' => $_POST['fecha_salida'] ?? '',
				'usuario' => $nivel,
				'relacion_id' => $_POST['destinatario_salida'] ?? 0,
				'motivo' => 'Salida registrada desde el modulo de inventario',
				'costo_unitario' => $_POST['costo_unitario_salida'] ?? null,
				'costo_total' => $_POST['costo_total_salida'] ?? null
			];
			echo $o->registrarSalidaInventario($datosSalida);
		}
	}

	$consult = $o->consultar($nivel1);
	$proveedoresInventario = $o->obtenerProveedoresActivos();
	$destinatariosInventario = $o->obtenerDestinatariosActivos();

	require_once("vista/".$pagina.".php");
} else {
	echo "PAGINA EN CONSTRUCCION";
}

?>

?>
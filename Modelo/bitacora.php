<?php

require_once('modelo/conexion.php');

class bitacora extends datos
{
	public function consultar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT b.ID, b.N_de_empleado, b.Accion, b.Fecha, " .
			"CONCAT(COALESCE(u.Nombre, ''), ' ', COALESCE(u.Apellido, '')) AS nombre_completo " .
			"FROM bitacora b " .
			"LEFT JOIN usuario u ON u.N_de_empleado = b.N_de_empleado " .
			"ORDER BY b.ID DESC";

		$stmt = $co->prepare($sql);
		$stmt->execute();

		$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (empty($filas)) {
			return '<tr><td colspan="3">No existen registros en la bitacora.</td></tr>';
		}

		$tabla = '';

		foreach ($filas as $fila) {
			$empleadoNumero = trim((string) ($fila['N_de_empleado'] ?? ''));
			$nombre = trim($fila['nombre_completo']);

			if ($empleadoNumero === '' && $nombre === '') {
				$empleado = 'Sin dato';
			} elseif ($empleadoNumero === '') {
				$empleado = $nombre;
			} elseif ($nombre === '') {
				$empleado = $empleadoNumero;
			} else {
				$empleado = $empleadoNumero . ' - ' . $nombre;
			}

			$fecha = $fila['Fecha'] ?? '';
			if (!empty($fecha) && $fecha !== '0000-00-00') {
				$fechaObj = date_create($fecha);
				if ($fechaObj instanceof DateTime) {
					$fecha = $fechaObj->format('d/m/Y');
				}
			} else {
				$fecha = 'Sin fecha';
			}

			$tabla .= '<tr>' .
				'<td>' . htmlspecialchars($empleado, ENT_QUOTES, 'UTF-8') . '</td>' .
				'<td>' . htmlspecialchars($fila['Accion'], ENT_QUOTES, 'UTF-8') . '</td>' .
				'<td>' . htmlspecialchars($fecha, ENT_QUOTES, 'UTF-8') . '</td>' .
				'</tr>';
		}

		return $tabla;
	}
}

?>
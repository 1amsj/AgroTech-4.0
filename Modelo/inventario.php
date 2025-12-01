<?php

require_once('modelo/conexion.php');

class Inventario extends datos
{
	private $id = null;
	private $nombre = '';
	private $categoria = '';
	private $fecha = '';
	private $stock = 0.0;
	private $nivel = '';
	private $proveedorId = '';
	private $precio = 0.0;

	public function set_id($valor)
	{
		$this->id = ctype_digit((string) $valor) ? (int) $valor : null;
	}

	public function set_nombre($valor)
	{
		$this->nombre = trim((string) $valor);
	}

	public function set_categoria($valor)
	{
		$this->categoria = trim((string) $valor);
	}

	public function set_fecha($valor)
	{
		$this->fecha = $this->normalizarFecha($valor);
	}

	public function set_stocka($valor)
	{
		$numero = str_replace(',', '.', (string) $valor);
		$this->stock = is_numeric($numero) ? (float) $numero : 0.0;
	}

	public function set_precio($valor)
	{
		$numero = str_replace(',', '.', (string) $valor);
		$this->precio = is_numeric($numero) ? (float) $numero : 0.0;
	}

	public function set_nivel($valor)
	{
		$this->nivel = $valor;
	}

	public function set_proveedor($valor)
	{
		$this->proveedorId = ctype_digit((string) $valor) ? (int) $valor : '';
	}

	public function registrar()
	{
		return $this->registrar1();
	}

	public function modificar()
	{
		return $this->modificar1();
	}

	public function eliminar()
	{
		return $this->eliminar1();
	}

	public function registrarEntradaInventario(array $datos)
	{
		return $this->registrarMovimientoInventario($datos, 'entrada');
	}

	public function registrarSalidaInventario(array $datos)
	{
		return $this->registrarMovimientoInventario($datos, 'salida');
	}

	public function obtenerProveedoresActivos(): array
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT ID, CONCAT(COALESCE(Nombre, ''), ' ', COALESCE(Apellido, '')) AS nombre
				FROM proveedor WHERE Estado = 1 ORDER BY nombre ASC";

		$stmt = $co->prepare($sql);
		$stmt->execute();

		$proveedores = [];
		foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
			$nombre = trim((string) $row['nombre']);
			if ($nombre === '') {
				$nombre = 'Proveedor #' . (int) $row['ID'];
			}
			$proveedores[] = [
				'id' => (string) $row['ID'],
				'nombre' => $nombre
			];
		}

		return $proveedores;
	}

	public function obtenerDestinatariosActivos(): array
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT ID, CONCAT(COALESCE(Nombre, ''), ' ', COALESCE(Apellido, '')) AS nombre
				FROM destinatario ORDER BY nombre ASC";

		$stmt = $co->prepare($sql);
		$stmt->execute();

		$destinatarios = [];
		foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
			$nombre = trim((string) $row['nombre']);
			if ($nombre === '') {
				$nombre = 'Destinatario #' . (int) $row['ID'];
			}
			$destinatarios[] = [
				'id' => (string) $row['ID'],
				'nombre' => $nombre
			];
		}

		return $destinatarios;
	}

	public function consultar($nivel1)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			$resultado = $co->prepare('SELECT * FROM inventario WHERE Estado = 1 ORDER BY Nombre ASC');
			$resultado->execute();

			$respuesta = '';

			foreach ($resultado as $r) {
				$nombre = htmlspecialchars($r['Nombre'], ENT_QUOTES, 'UTF-8');
				$fecha = htmlspecialchars($r['Fecha'], ENT_QUOTES, 'UTF-8');
				$categoria = htmlspecialchars($r['Categoria'], ENT_QUOTES, 'UTF-8');
				$cantidad = htmlspecialchars($r['Cantidad'], ENT_QUOTES, 'UTF-8');
				$precio = htmlspecialchars($r['precio'] ?? '', ENT_QUOTES, 'UTF-8');

				$respuesta .= '
				<div class="ag-courses_item">
					<a href="#" class="ag-courses-item_link" data-product-id="' . (int) $r['ID'] . '" data-product-name="' . $nombre . '" data-product-category="' . $categoria . '" data-product-date="' . $fecha . '" data-product-stock="' . $cantidad . '" data-product-price="' . $precio . '">
						<div class="ag-courses-item_bg"></div>

						<div class="ag-courses-item_title">
						' . $nombre . '
						</div>

						<div class="ag-courses-item_date-box">
						Fecha:
						<span class="ag-courses-item_date">
							' . $fecha . '
						</span>
						</div>
					</a>
				</div>
			';
			}

			return $respuesta;
		} catch (Exception $e) {
			return '';
		}
	}

	private function registrar1()
	{
		if ($this->nombre === '') {
			return 'El nombre es obligatorio';
		}

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$co->beginTransaction();

		try {
			$sql = "INSERT INTO inventario (Nombre, Categoria, Fecha, Cantidad, Estado, precio)
				VALUES (:nombre, :categoria, :fecha, :cantidad, 1, :precio)";

			$stmt = $co->prepare($sql);
			$stmt->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
			$stmt->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);
			$stmt->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
			$stmt->bindValue(':cantidad', $this->stock, PDO::PARAM_STR);
			$stmt->bindValue(':precio', $this->formatearMonto($this->precio), PDO::PARAM_STR);
			$stmt->execute();

			$productoId = (int) $co->lastInsertId();

			if ($this->stock > 0) {
				$this->insertarMovimiento($co, [
					'id_inventario' => $productoId,
					'tipo' => 'entrada',
					'cantidad' => $this->stock,
					'fecha' => $this->fecha,
					'motivo' => 'Registro inicial de inventario',
					'usuario' => $this->nivel,
					'stock_resultante' => $this->stock,
					'costo_unitario' => $this->formatearMonto($this->precio),
					'costo_total' => $this->formatearMonto($this->stock * $this->precio),
					'id_proveedor' => $this->proveedorId
				]);
			}

			$co->commit();
			$this->bitacora('Se registro un producto', 'inventario', $this->nivel);
			return 'Registro incluido';
		} catch (Exception $e) {
			$co->rollBack();
			return $e->getMessage();
		}
	}

	private function modificar1()
	{
		if ($this->id === null) {
			return 'Producto no registrado';
		}

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$producto = $this->obtenerProductoPorId($co, $this->id);
		if (!$producto) {
			return 'Producto no registrado';
		}

		try {
			$sql = "UPDATE inventario SET Nombre = :nombre, Categoria = :categoria, Fecha = :fecha,
				Cantidad = :cantidad, precio = :precio WHERE ID = :id";

			$stmt = $co->prepare($sql);
			$stmt->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
			$stmt->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);
			$stmt->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
			$stmt->bindValue(':cantidad', $this->stock, PDO::PARAM_STR);
			$stmt->bindValue(':precio', $this->formatearMonto($this->precio), PDO::PARAM_STR);
			$stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
			$stmt->execute();

			$this->bitacora('Se modifico un producto', 'inventario', $this->nivel);
			return 'Registro modificado';
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function eliminar1()
	{
		if ($this->id === null) {
			return 'Producto no registrado';
		}

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (!$this->obtenerProductoPorId($co, $this->id)) {
			return 'Producto no registrado';
		}

		try {
			$stmt = $co->prepare('UPDATE inventario SET Estado = 0 WHERE ID = :id');
			$stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
			$stmt->execute();

			$this->bitacora('Se elimino un producto', 'inventario', $this->nivel);
			return 'Registro eliminado';
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function registrarMovimientoInventario(array $datos, string $tipo)
	{
		$idInventario = isset($datos['id_inventario']) ? (int) $datos['id_inventario'] : 0;
		$cantidad = isset($datos['cantidad']) ? (float) str_replace(',', '.', (string) $datos['cantidad']) : 0.0;
		$fecha = $this->normalizarFecha($datos['fecha'] ?? '');
		$usuario = $datos['usuario'] ?? '';
		$relacionId = isset($datos['relacion_id']) ? (int) $datos['relacion_id'] : 0;
		$motivo = $datos['motivo'] ?? ($tipo === 'entrada' ? 'Entrada de inventario' : 'Salida de inventario');
		$costoUnitario = $this->sanitizarMonto($datos['costo_unitario'] ?? null);
		$costoTotal = $this->sanitizarMonto($datos['costo_total'] ?? null);

		if ($idInventario <= 0) {
			return 'Producto no registrado';
		}

		if ($cantidad <= 0) {
			return 'La cantidad debe ser mayor a cero';
		}

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$co->beginTransaction();

		try {
			$producto = $this->obtenerProductoPorId($co, $idInventario, true);
			if (!$producto) {
				$co->rollBack();
				return 'Producto no registrado';
			}

			$stockActual = (float) $producto['Cantidad'];
			$precioProducto = isset($producto['precio']) ? (float) str_replace(',', '.', (string) $producto['precio']) : 0.0;
			$nuevoStock = $tipo === 'entrada' ? $stockActual + $cantidad : $stockActual - $cantidad;

			if ($nuevoStock < 0) {
				$co->rollBack();
				return 'La cantidad excede el stock disponible';
			}

			if ($costoUnitario === null && $cantidad > 0) {
				if ($costoTotal !== null) {
					$costoUnitario = $costoTotal / $cantidad;
				} else {
					$costoUnitario = $precioProducto;
				}
			}

			if ($costoTotal === null && $costoUnitario !== null) {
				$costoTotal = $cantidad * $costoUnitario;
			}

			if ($costoUnitario === null) {
				$costoUnitario = 0.0;
			}

			if ($costoTotal === null) {
				$costoTotal = $cantidad * $costoUnitario;
			}

			$costoUnitario = round($costoUnitario, 2);
			$costoTotal = round($costoTotal, 2);

			$nuevoPrecio = ($tipo === 'entrada' && $costoUnitario > 0) ? $costoUnitario : null;
			$this->actualizarStock($co, $idInventario, $nuevoStock, $nuevoPrecio);

			$movimientoId = $this->insertarMovimiento($co, [
				'id_inventario' => $idInventario,
				'tipo' => $tipo,
				'cantidad' => $cantidad,
				'fecha' => $fecha,
				'motivo' => $motivo,
				'usuario' => $usuario,
				'stock_resultante' => $nuevoStock,
				'costo_unitario' => $this->formatearMonto($costoUnitario),
				'costo_total' => $this->formatearMonto($costoTotal)
			]);

			if ($tipo === 'entrada' && $relacionId > 0) {
				$stmt = $co->prepare('INSERT INTO movimiento_proveedor (id_movimiento, id_proveedor) VALUES (:mov, :prov)');
				$stmt->bindValue(':mov', $movimientoId, PDO::PARAM_INT);
				$stmt->bindValue(':prov', $relacionId, PDO::PARAM_INT);
				$stmt->execute();
			}

			if ($tipo === 'salida' && $relacionId > 0) {
				$stmt = $co->prepare('INSERT INTO movimiento_destinatario (id_movimiento, id_destinatario) VALUES (:mov, :dest)');
				$stmt->bindValue(':mov', $movimientoId, PDO::PARAM_INT);
				$stmt->bindValue(':dest', $relacionId, PDO::PARAM_INT);
				$stmt->execute();
			}

			$co->commit();

			$accionBitacora = $tipo === 'entrada' ? 'Se registro una entrada de producto' : 'Se registro una salida de producto';
			$this->bitacora($accionBitacora, 'inventario', $usuario);

			return $tipo === 'entrada' ? 'Entrada registrada' : 'Salida registrada';
		} catch (Exception $e) {
			$co->rollBack();
			return $e->getMessage();
		}
	}

	private function obtenerProductoPorId(PDO $co, int $id, bool $forUpdate = false)
	{
		$sql = 'SELECT * FROM inventario WHERE ID = :id AND Estado = 1' . ($forUpdate ? ' FOR UPDATE' : '');
		$stmt = $co->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
	}

	private function actualizarStock(PDO $co, int $idInventario, float $nuevoStock, ?float $nuevoPrecio = null)
	{
		if ($nuevoPrecio !== null) {
			$stmt = $co->prepare('UPDATE inventario SET Cantidad = :cantidad, precio = :precio WHERE ID = :id');
			$stmt->bindValue(':precio', $this->formatearMonto($nuevoPrecio), PDO::PARAM_STR);
		} else {
			$stmt = $co->prepare('UPDATE inventario SET Cantidad = :cantidad WHERE ID = :id');
		}
		$stmt->bindValue(':cantidad', $nuevoStock, PDO::PARAM_STR);
		$stmt->bindValue(':id', $idInventario, PDO::PARAM_INT);
		$stmt->execute();
	}

	private function insertarMovimiento(PDO $co, array $datos)
	{
		$stmt = $co->prepare('INSERT INTO movimiento (id_inventario, tipo, cantidad, motivo, costo_unitario, costo_total, stock_resultante, fecha, id_usuario)
			VALUES (:inventario, :tipo, :cantidad, :motivo, :costo_unitario, :costo_total, :stock_resultante, :fecha, :usuario)');

		$stmt->bindValue(':inventario', $datos['id_inventario'], PDO::PARAM_INT);
		$stmt->bindValue(':tipo', $datos['tipo'], PDO::PARAM_STR);
		$stmt->bindValue(':cantidad', $datos['cantidad'], PDO::PARAM_STR);
		$stmt->bindValue(':motivo', $datos['motivo'], PDO::PARAM_STR);
		$stmt->bindValue(':costo_unitario', $datos['costo_unitario'] ?? '0.00', PDO::PARAM_STR);
		$stmt->bindValue(':costo_total', $datos['costo_total'] ?? '0.00', PDO::PARAM_STR);
		$stmt->bindValue(':stock_resultante', $datos['stock_resultante'], PDO::PARAM_STR);
		$stmt->bindValue(':fecha', $datos['fecha'], PDO::PARAM_STR);
		$stmt->bindValue(':usuario', $datos['usuario'], PDO::PARAM_STR);
		$stmt->execute();

		$movimientoId = (int) $co->lastInsertId();

		if (isset($datos['id_proveedor']) && (int) $datos['id_proveedor'] > 0) {
			$stmtProveedor = $co->prepare('INSERT INTO movimiento_proveedor (id_movimiento, id_proveedor) VALUES (:mov, :prov)');
			$stmtProveedor->bindValue(':mov', $movimientoId, PDO::PARAM_INT);
			$stmtProveedor->bindValue(':prov', (int) $datos['id_proveedor'], PDO::PARAM_INT);
			$stmtProveedor->execute();
		}

		return $movimientoId;
	}

	private function normalizarFecha($fecha)
	{
		if (empty($fecha)) {
			return date('Y-m-d');
		}

		$fecha = substr((string) $fecha, 0, 10);
		$timestamp = strtotime($fecha);
		if ($timestamp === false) {
			return date('Y-m-d');
		}

		return date('Y-m-d', $timestamp);
	}

	private function sanitizarMonto($valor): ?float
	{
		if ($valor === null) {
			return null;
		}

		if (is_array($valor)) {
			return null;
		}

		$numero = str_replace(',', '.', (string) $valor);
		if (!is_numeric($numero)) {
			return null;
		}

		return max(0.0, (float) $numero);
	}

	private function formatearMonto($valor): string
	{
		return number_format((float) $valor, 2, '.', '');
	}

	private function bitacora($accion, $modulo, $id)
	{
		try {
			parent::registrar_bitacora($accion, $modulo, $id);
		} catch (Exception $e) {
			return $e->getMessage();
		}

		return null;
	}
}

?>
<?php

require_once('modelo/conexion.php');
class Destinatario extends datos
{

	private $nombre;
	private $categoria;
	private $stocka;
	private $fecha;
	private $id;
	private $nivel;



	public function set_nombre($valor)
	{

		$this->nombre = $valor;

	}


	public function set_categoria($valor)
	{

		$this->categoria = $valor;

	}

	public function set_fecha($fecha)
	{

		$this->fecha = $fecha;
	}

	public function set_stocka($stocka)
	{

		$this->stocka = $stocka;
	}

	public function set_nivel($valor)
	{
		$this->nivel = $valor;

	}

	public function registrar()
	{
		$val = $this->registrar1();
		echo $val;
	}

	public function modificar()
	{
		$val = $this->modificar1();
		echo $val;
	}

	public function eliminar()
	{
		$val = $this->eliminar1();
		echo $val;
	}
	public function registrar1()
	{

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (!$this->existe($this->id)) {
			try {
				$t = "1";
				$r = $co->prepare("Insert into inventario(
						
                    Nombre, 
                    Categoria,
                    Fecha,
                    Cantidad,
					Estado
                    )
            

                    Values(
                        :nombre,
                        :categoria,
						:fecha,
                        :cantidad,
						:estado
                    )");
				$r->bindParam(':nombre', $this->nombre);
				$r->bindParam(':categoria', $this->categoria);
				$r->bindParam(':fecha', $this->fecha);
				$r->bindParam(':cantidad', $this->stocka);
				$r->bindParam(':estado', $t);
				$r->execute();
				$this->bitacora("Se registro un producto", "inventario", $this->nivel);

				return "Registro incluido";

			} catch (Exception $e) {
				return $e->getMessage();
			}

		} else {
			return "Nombre registrado";
		}


	}

	public function modificar1()
	{


		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($this->existe($this->id)) {
			try {
				$t = "1";
				$r = $co->prepare("Update inventario set 
                            
                        ID=:ID,
                        Nombre=:Nombre,
                        Categoria=:Categoria,
                        Fecha=:Fecha,
                        Estado=:Estado,
                        Cantidad=:Cantidad,
                        where
						ID =:ID
                            
                        ");
				$r->bindParam(':Nombre', $this->nombre);
				$r->bindParam(':Categoria', $this->categoria);
				$r->bindParam(':Fecha', $this->fecha);
				$r->bindParam(':Estado', $t);
				$r->bindParam(':Cantidad', $this->stocka);

				$r->execute();

				$this->bitacora("Se modifico un producto", "inventario", $this->nivel);
				return "Registro modificado";

			} catch (Exception $e) {
				return $e->getMessage();
			}

		} else {
			return "El producto no está registrado";
		}

	}

	private function existe($id)
	{

		$co = $this->conecta();

		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		try {


			$resultado = $co->prepare("Select * from inventario where ID =:ID");

			$resultado->bindParam(':ID', $id);
			$resultado->execute();
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {

				return true;

			} else {

				return false;
			}

		} catch (Exception $e) {

			return false;
		}
	}


	public function eliminar1()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($this->existe($this->id)) {


			try {
				$r = $co->prepare("Update inventario set 
                        Estado=0
                        where
						ID =:ID
                            
                        ");
				$r->bindParam(':ID', $this->id);
				$r->execute();
				$this->bitacora("Se elimino un producto", "inventario", $this->nivel);
				return "Registro Eliminado";

			} catch (Exception $e) {
				return $e->getMessage();
			}



		} else {
			return "Producto no registrado";
		}
	}

	private function bitacora($accion, $modulo, $id)
	{
		try {
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			parent::registrar_bitacora($accion, $modulo, $id);



			;
		} catch (Exception $e) {
			return $e->getMessage();
		}

	}

	public function consultar($nivel1)
	{
		$co = $this->conecta();

		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {


			$resultado = $co->prepare('SELECT * FROM inventario WHERE Estado=1;');
			$resultado->execute();
			$respuesta = "";

			foreach ($resultado as $r) {
				$nombre = htmlspecialchars($r['Nombre'], ENT_QUOTES, 'UTF-8');
				$fecha = htmlspecialchars($r['Fecha'], ENT_QUOTES, 'UTF-8');

				$respuesta .= '
				<div class="ag-courses_item">
					<a href="#" class="ag-courses-item_link" data-product-id="' . (int)$r['ID'] . '">
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

			return false;
		}
	}


}

?>
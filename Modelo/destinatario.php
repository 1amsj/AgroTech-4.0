<?php

require_once('modelo/conexion.php');
class Destinatario extends datos
{

	private $nombre;
	private $apellido;
	private $telefono;
	private $descripcion;
	private $id;
	private $nivel;



	public function set_id($valor)
	{

		$this->id = is_numeric($valor) ? (int)$valor : null;

	}



	public function set_nombre($valor)
	{

		$this->nombre = trim($valor);

	}


	public function set_apellido($valor)
	{

		$this->apellido = trim($valor);

	}

	public function set_telefono($telefono)
	{

		$this->telefono = preg_replace('/[^0-9]/', '', (string)$telefono);
	}

	public function set_descripcion($descripcion)
	{

		$this->descripcion = trim($descripcion);
	}

	public function set_nivel($valor)
	{
		$this->nivel = $valor;

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
	public function registrar1()
	{

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$r = $co->prepare("Insert into destinatario(
						
					Nombre, 
					Apellido,
					Descripcion,
				Telefono
					)
            

					Values(
						:nombre,
						:apellido,
						:descripcion,
						:telefono
					)");
				$r->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
				$r->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
				$r->bindValue(':descripcion', $this->descripcion, PDO::PARAM_STR);
				$r->bindValue(':telefono', $this->telefono, PDO::PARAM_STR);
				$r->execute();
				$this->bitacora("Se registro un destinatario", "destinatario", $this->nivel);

				return "Registro incluido";

			} catch (Exception $e) {
				return $e->getMessage();
			}


	}

	public function modificar1()
	{


		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (empty($this->id)) {
			return "Identificador inválido";
		}
		if ($this->existe($this->id)) {
			try {
				$r = $co->prepare("Update destinatario set 
                            
                        Nombre=:Nombre,
                        Apellido=:Apellido,
                        Descripcion=:Descripcion,
					Telefono=:Telefono
					where
					ID =:ID
                            
                        ");
				$r->bindValue(':Nombre', $this->nombre, PDO::PARAM_STR);
				$r->bindValue(':Apellido', $this->apellido, PDO::PARAM_STR);
				$r->bindValue(':Descripcion', $this->descripcion, PDO::PARAM_STR);
				$r->bindValue(':Telefono', $this->telefono, PDO::PARAM_STR);
				$r->bindValue(':ID', $this->id, PDO::PARAM_INT);

				$r->execute();

				$this->bitacora("Se modifico un destinatario", "destinatario", $this->nivel);
				return "Registro modificado";

			} catch (Exception $e) {
				return $e->getMessage();
			}

		} else {
			return "El destinatario no esta registrado";
		}

	}

 private function existe($id){
		
		$co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		try{
			
			
			$resultado = $co->prepare("Select * from destinatario where ID =:ID");
			
			$resultado->bindParam(':ID',$id);
			$resultado->execute();
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){ 

				return true; 
			    
			}
			else{
				
				return false; 
			}
			
		}catch(Exception $e){
			
			return false;
		}
	}


	public function eliminar1(){
        $co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (empty($this->id)) {
			return "Identificador inválido";
		}
		if($this->existe($this->id)){
		

			try {
					$r=$co->prepare("Delete from destinatario where ID = :ID");
					$r->bindValue(':ID',$this->id, PDO::PARAM_INT);
					$r->execute();
					$this->bitacora("Se elimino un destinatario", "destinatario",$this->nivel);
					return "Registro Eliminado";
                    
			} catch(Exception $e) {
				return $e->getMessage();
			}
			
		

		}
		else{
			return "Destinatario no registrado";
		}
    }

    private function bitacora($accion, $modulo,$id){
        try {
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        parent::registrar_bitacora($accion, $modulo,$id);
    
                    
                    
                    ;
            } catch(Exception $e) {
                return $e->getMessage();
            }
        
    }
    
public function consultar($nivel1){
    $co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
			
			
			$resultado = $co->prepare('SELECT * FROM destinatario;');
			$resultado->execute();
           $respuesta="";

			foreach($resultado as $r){
				$respuesta .= '<tr data-id="' . $r['ID'] . '" data-nombre="' . htmlspecialchars($r['Nombre'], ENT_QUOTES, 'UTF-8') . '" data-apellido="' . htmlspecialchars($r['Apellido'], ENT_QUOTES, 'UTF-8') . '" data-telefono="' . htmlspecialchars((string)$r['Telefono'], ENT_QUOTES, 'UTF-8') . '" data-descripcion="' . htmlspecialchars($r['Descripcion'], ENT_QUOTES, 'UTF-8') . '">';
				$respuesta .= '<td>' . htmlspecialchars($r['Nombre'], ENT_QUOTES, 'UTF-8') . '</td>';
				$respuesta .= '<td>' . htmlspecialchars($r['Apellido'], ENT_QUOTES, 'UTF-8') . '</td>';
				$respuesta .= '<td>' . htmlspecialchars((string)$r['Telefono'], ENT_QUOTES, 'UTF-8') . '</td>';
				$respuesta .= '<td>' . htmlspecialchars($r['Descripcion'], ENT_QUOTES, 'UTF-8') . '</td>';
				if (in_array("modificar_destinatario", $nivel1)) {
					$respuesta .= '<td class="text-nowrap"><button type="button" class="btn-modificar btn-sm js-edit-destinatario" data-toggle="modal" data-target="#editDestinatarioModal">Modificar</button></td>';
				} else {
					$respuesta .= '<td></td>';
				}
				if (in_array("eliminar_destinatario", $nivel1)) {
					$respuesta .= '<td class="text-nowrap"><button type="button" class="btn-eliminar btn-sm js-delete-destinatario" data-toggle="modal" data-target="#confirmDeleteModal">Eliminar</button></td>';
				} else {
					$respuesta .= '<td></td>';
				}
				$respuesta .= '</tr>';
			}

           
            return $respuesta;
         
							
							


			
			
		}catch(Exception $e){
			
			return false;
		}
}


}

?>
<?php

require_once('modelo/conexion.php');
class Proveedor extends datos
{

	private $nombre;
	private $apellido;
	private $telefono;
	private $descripcion;
	private $direccion;
	private $correo;
	private $id;
	private $nivel;



	public function set_nombre($valor)
	{

		$this->nombre = $valor;

	}
	public function set_id($valor)
	{

		$this->id = $valor;

	}
	public function set_correo($valor)
	{

		$this->correo = $valor;

	}

	public function set_apellido($valor)
	{

		$this->apellido = $valor;

	}
	public function set_telefono($valor)
	{

		$this->telefono = $valor;

	}

	public function set_descripcion($valor)
	{

		$this->descripcion = $valor;


	}
	public function set_direccion($valor)
	{

		$this->direccion = $valor;

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
				$r = $co->prepare("INSERT INTO proveedor (
					Nombre,
					Apellido,
					Correo,
					Descripcion,
					Telefono,
					Direccion,
					Estado
				) VALUES (
					:nombre,
					:apellido,
					:correo,
					:descripcion,
					:telefono,
					:direccion,
					:estado
				)");
				$r->bindParam(':nombre', $this->nombre);
				$r->bindParam(':apellido', $this->apellido);
				$r->bindParam(':correo', $this->correo);
				$r->bindParam(':descripcion', $this->descripcion);
				$r->bindParam(':telefono', $this->telefono);
				$r->bindParam(':direccion', $this->direccion);
				$r->bindParam(':estado',$t);	
				$r->execute();
				$this->bitacora("Se registro un proveedor", "proveedor", $this->nivel);

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
				$r = $co->prepare("Update proveedor set 
                            
                        ID=:ID,
                        Nombre=:Nombre,
                        Apellido=:Apellido,
                        Descripcion=:Descripcion,
                        Estado=:Estado,
                        Telefono=:Telefono,
                        Direccion=:Direccion
                        where
						ID =:ID
                            
                        ");
				$r->bindParam(':Nombre', $this->nombre);
				$r->bindParam(':Apellido', $this->apellido);
				$r->bindParam(':Descripcion', $this->descripcion);
				$r->bindParam(':Estado', $t);
				$r->bindParam(':Telefono', $this->telefono);
				$r->bindParam(':Direccion', $this->direccion);
				// bind ID for WHERE clause
				$r->bindParam(':ID',$this->id);

				$r->execute();

				$this->bitacora("Se modifico un proveedor", "proveedor", $this->nivel);
				return "Registro modificado";

			} catch (Exception $e) {
				return $e->getMessage();
			}

		} else {
			return "El proveedor no esta registrado";
		}

	}

 private function existe($id){
		
		$co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		try{
			
			
			$resultado = $co->prepare("Select * from proveedor where ID =:ID");
			
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
		if($this->existe($this->id)){
		

			try {
					$r=$co->prepare("Update proveedor set 
                        Estado=0
                        where
						ID =:ID
                            
                        ");
					$r->bindParam(':ID',$this->id);
					$r->execute();
                    $this->bitacora("Se elimino un proveedor", "proveedor",$this->nivel);
					return "Registro Eliminado";
                    
			} catch(Exception $e) {
				return $e->getMessage();
			}
			
		

		}
		else{
			return "Proveedor no registrado";
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
			
			
			$resultado = $co->prepare('SELECT * FROM proveedor WHERE Estado=1;');
			$resultado->execute();
           $respuesta="";

            foreach($resultado as $r){
                $respuesta= $respuesta.'<tr>';
				$respuesta=$respuesta."<th style='display:none'>".$r['ID']."</th>";
                $respuesta=$respuesta."<th>".$r['Nombre']."</th>";
                $respuesta=$respuesta."<th>".$r['Apellido']."</th>";
                $respuesta=$respuesta."<th>".$r['Correo']."</th>";
                $respuesta=$respuesta."<th>".$r['Telefono']."</th>";
				$respuesta=$respuesta."<th>".$r['Descripcion']."</th>";
                $respuesta=$respuesta."<th>".$r['Direccion']."</th>";

                
                $respuesta=$respuesta.'<th>';
                if (in_array("modificar_proveedores",$nivel1)) {
              
                $respuesta=$respuesta.'<button type="button" class="btn-modificar btn-sm" data-toggle="modal" data-target="#loginModal1" onclick="modificar(`'.$r['ID'].'`)">Modificar</button>';
            }
                if(in_array("eliminar_proveedores",$nivel1)){
                    
					$respuesta = $respuesta . '<td><button type="button" class="btn-eliminar btn-sm" data-id="'.$r['ID'].'" onclick="eliminar1(`'.$r['ID'].'`)" data-toggle="modal" data-target="#confirmDeleteModal">Eliminar</button></td>';
                }
            $respuesta=$respuesta.'</th>';
            $respuesta= $respuesta.'</tr>';
             

            }

           
            return $respuesta;
         
							
							


			
			
		}catch(Exception $e){
			
			return false;
		}
}


}

?>
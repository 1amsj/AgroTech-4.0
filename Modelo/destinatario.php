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



	public function set_nombre($valor)
	{

		$this->nombre = $valor;

	}


	public function set_apellido($valor)
	{

		$this->apellido = $valor;

	}

	public function set_telefono($telefono)
	{

		$this->telefono = $telefono;
	}

	public function set_descripcion($descripcion)
	{

		$this->descripcion = $descripcion;
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
				$r = $co->prepare("Insert into destinatario(
						
                    Nombre, 
                    Apellido,
                    Descripcion,
                    Telefono,
					Estado
                    )
            

                    Values(
                        :nombre,
                        :apellido,
						:correo,
                        :telefono,
						:estado
                    )");
				$r->bindParam(':nombre', $this->nombre);
				$r->bindParam(':apellido', $this->apellido);
				$r->bindParam(':descripcion', $this->descripcion);
				$r->bindParam(':telefono', $this->telefono);
				$r->bindParam(':estado',$t);	
				$r->execute();
				$this->bitacora("Se registro un destinatario", "destinatario", $this->nivel);

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
				$r = $co->prepare("Update destinatario set 
                            
                        ID=:ID,
                        Nombre=:Nombre,
                        Apellido=:Apellido,
                        Descripcion=:Descripcion,
                        Estado=:Estado,
                        Telefono=:Telefono,
                        where
						ID =:ID
                            
                        ");
				$r->bindParam(':Nombre', $this->nombre);
				$r->bindParam(':Apellido', $this->apellido);
				$r->bindParam(':Descripcion', $this->descripcion);
				$r->bindParam(':Estado', $t);
				$r->bindParam(':Telefono', $this->telefono);

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
		if($this->existe($this->id)){
		

			try {
					$r=$co->prepare("Update destinatario set 
                        Estado=0
                        where
						ID =:ID
                            
                        ");
					$r->bindParam(':ID',$this->id);
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
			
			
			$resultado = $co->prepare('SELECT * FROM destinatario WHERE Estado=1;');
			$resultado->execute();
           $respuesta="";

            foreach($resultado as $r){
                $respuesta= $respuesta.'<tr>';
                $respuesta=$respuesta."<th>".$r['Nombre']."</th>";
                $respuesta=$respuesta."<th>".$r['Apellido']."</th>";
                $respuesta=$respuesta."<th>".$r['Telefono']."</th>";
				$respuesta=$respuesta."<th>".$r['Descripcion']."</th>";

                
                $respuesta=$respuesta.'<th>';
                if (in_array("modificar_destinatario",$nivel1)) {
                    # code...
                
                $respuesta=$respuesta.'<button type="button" class="btn-modificar btn-sm" data-toggle="modal" data-target="#loginModal1" onclick="modificar(`'.$r['ID'].'`)">Modificar</button>';
            }
                if(in_array("eliminar_destinatario",$nivel1)){
                    // Make delete button behave like the modify button (open the confirm modal)
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
<?php

require_once('modelo/conexion.php');
class entrada extends datos{
    private $usuario;
	private $clave;


    public function set_usuario($valor){
		$this->usuario = $valor; 
	}
	public function set_clave($valor){
		$this->clave = $valor; 
	}
	
    public function busca(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
		

			$resultado = $co->prepare("SELECT usuarios.clave, usuarios.id_rol, usuarios.id FROM usuarios WHERE usuarios.nombre =:usua");
			
			$resultado->bindParam(':usua',$this->usuario);
		
			$resultado->execute();


			foreach($resultado as $r){
				$fila= array($r["clave"],$r["id_rol"],$r["id"]);

            }
	
			
			if(!empty($fila[0])){

			
				return $fila;

			    
			}
			else{
				$fila=array("El usuario ingresado es incorrecto");
				return $fila;
			}

			
		}catch(Exception $e){
			return $e;
		}
	}


	public function permisos($rol){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
		

			$resultado = $co->prepare("SELECT p.nombre as permiso FROM rol r 
            INNER JOIN rol_permiso rp ON r.id=rp.id_rol INNER JOIN permisos p ON rp.id_permiso=p.id 
            WHERE r.id = :rol 
            ORDER BY rp.id_permiso");
			
			$resultado->bindParam(':rol',$rol);
		
			$resultado->execute();

			$permisos = [];
            $i = 0;
			foreach($resultado as $r){
				$permisos[$i] = $r["permiso"];
                $i++;

            }

			
			
			if(!empty($permisos[0])){

				
				return $permisos;
			    
			}
			else{
				
				return "ha ocurrido un error";
			}
	
			
		}catch(Exception $e){
			return $e;
		}
	}



}

?>
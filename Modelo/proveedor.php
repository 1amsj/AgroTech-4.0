<?php

require_once('modelo/conexion.php');
class entrada extends datos{
	private $usuario;
	private $valor; 

	private $nombre;
	private $rol;
    private $telefono;
    private $descripcion;
    private $id;
    private $nivel;


    public function set_usuario($valor){
		$this->usuario = $valor; 
	}
	public function set_clave($valor){
		$this->clave = $valor; 
	}
	public function set_nombre($valor){
       
		$this->nombre = $valor;
        
	}

	
    public function set_apellido($valor){

		$this->apellido = $valor;

	}
    public function set_descripcion($valor){
       
		$this->contraseña = $valor; 
        

	}
    public function set_nivel($valor){
		$this->nivel = $valor; 

	}



    public function busca(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
		

			$resultado = $co->prepare("SELECT usuario.Contrasena, usuario.ID_rol, usuario.Nombre, usuario.Apellido FROM usuario WHERE usuario.N_de_empleado =:usua;");
			
			$resultado->bindParam(':usua',$this->usuario);
		
			$resultado->execute();


			foreach($resultado as $r){
				$fila= array($r["Contrasena"],$r["ID_rol"],$r["Nombre"]." ".$r["Apellido"]);

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
            INNER JOIN rol_permiso rp ON r.id=rp.ID_ROL INNER JOIN permisos p ON rp.ID_Permiso=p.id 
            WHERE r.id = :rol;");
			
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
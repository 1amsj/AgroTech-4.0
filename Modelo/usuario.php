<?php

require_once('modelo/conexion.php');
class usuarios extends datos{

	private $nombre;
	private $rol;
    private $apellido;
    private $contraseña;
    private $cdt;
    private $id;
    private $nivel;


	public function set_nombre($valor){
       
		$this->nombre = $valor;
        
	}
    public function set_user($valor){
      
		$this->id = $valor; 
        
	}
	
    public function set_apellido($valor){

		$this->apellido = $valor;

	}
    public function set_contraceña($valor){
       
		$this->contraseña = $valor; 
        

	}
    public function set_cdt($valor){
        
		$this->cdt = $valor;
    
	}
    public function set_rol($valor){
       
		$this->rol = $valor; 
        
       
	}
    public function set_nivel($valor){
		$this->nivel = $valor; 

	}


    public function registrar(){
       $val= $this->registrar1();
       echo $val;
    }

    public function modificar(){
        $val=  $this->modificar1();
        echo $val;
    }

    public function eliminar(){
        $val= $this->eliminar1();
        echo $val;
    }



   
    public function registrar1(){


        $co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(!$this->existe($this->id)){
            try{
                $t="1";
                $r= $co->prepare("Insert into usuario(
						
                    N_de_empleado,
                    nombre, 
                    Apellido,
                    Contrasena,
                    estado,
                    ID_rol,
                    ID_CDT 
                    )
            

                    Values(
                        :N_de_empleado,
                        :nombre,
                        :apellido,
                        :contrasena,
                        :estado,
                        :id_rol,
                        :id_cdt
                    )");
                $r->bindParam(':N_de_empleado',$this->id);	
                $r->bindParam(':nombre',$this->nombre);	
                $r->bindParam(':apellido',$this->apellido);	
                $r->bindParam(':contrasena',$this->contraseña);	
                $r->bindParam(':estado',$t);	
                $r->bindParam(':id_rol',$this->rol);	
                $r->bindParam(':id_cdt',$this->cdt);	    
                $r->execute();
                $this->bitacora("se registro un usuario", "usuarios",$this->nivel);
             
                    return "Registro incluido";	
                
            }catch(Exception $e){
                return $e->getMessage();
            }
                
            }
            else{
                return "nombre registrado";
            }
    








        }

        public function modificar1(){


            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($this->existe($this->id)){
                try{
                    $t="1";
                    $r= $co->prepare("Update usuarios set 
                            
                       
                        nombre=:nombre,
                        
                        correo=:correo,
                        clave=:clave,
                        estado=:estado,
                        id_rol=:id_rol
                        where
						id =:id
                        
                
    
                    
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        ");
                        $r->bindParam(':nombre',$this->nombre);	
                        $r->bindParam(':id',$this->id);
                        $r->bindParam(':clave',$this->contraseña);	
                        $r->bindParam(':estado',$t);	
                        $r->bindParam(':id_rol',$this->rol);	
                 
                    $r->execute();
    
                    $this->bitacora("se modifico un usuario", "usuarios",$this->nivel);
                        return "Registro modificado";	
                    
                }catch(Exception $e){
                    return $e->getMessage();
                }
                    
                }
                else{
                    return "el usuario no esta registrado";
                }
        
    
    
    
    
    
    
    
    
            }


        public function cdt(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			try {
					$r = $co->prepare("SELECT ID, Nombre FROM cdt");
					$r->execute();

					if($r){
				
				$respuesta = '';
					
					$respuesta = $respuesta.'<option value="seleccionar" selected hidden>-Seleccionar-</option>';
				foreach($r as $r){
					
							$respuesta =$respuesta.'<option value="'.$r['ID'].'">'.$r['Nombre'].'</option>';
							
				}

				
				return $respuesta;
			    
			}
			else{
				return '';
			}







						
			} catch(Exception $e) {
				return $e->getMessage();
			}
		
		
	}

    public function roles(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			try {
					$r = $co->prepare("SELECT ID, Nombre FROM rol");
					
					
					
					$r->execute();

					if($r){
				
				$respuesta = '';
					
					$respuesta = $respuesta.'<option value="seleccionar" selected hidden>-Seleccionar-</option>';
				foreach($r as $r){
					
							$respuesta =$respuesta.'<option value="'.$r['ID'].'">'.$r['Nombre'].'</option>';
							
				}

				
				return $respuesta;
			    
			}
			else{
				return '';
			}







						
			} catch(Exception $e) {
				return $e->getMessage();
			}
		
		
	}
    

public function consultar($nivel1){
    $co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
			
			
			$resultado = $co->prepare('SELECT a.id, a.nombre,a.correo, b.name FROM (SELECT id as ide, nombre as name FROM rol) as b , usuarios as a WHERE b.ide = a.id_rol');
			$resultado->execute();
           $respuesta="";

            foreach($resultado as $r){
                
                $respuesta=$respuesta."<th>".$r['id']."</th>";
                $respuesta=$respuesta."<th>".$r['name']."</th>";
                $respuesta=$respuesta."<th>".$r['nombre']."</th>";
                $respuesta=$respuesta."<th>".$r['correo']."</th>";
                
                $respuesta=$respuesta.'<th>';
                if (in_array("modificar usuario",$nivel1)) {
                    # code...
                
                
                $respuesta=$respuesta.'<a href="#editEmployeeModal" class="edit" data-toggle="modal" onclick="modificar(`'.$r['id'].'`)">
                <i class="material-icons"  title="MODIFICAR"><img src="assets/icon/pencill.png"/></i>
               </a>';
            }
            if(in_array("eliminar usuario",$nivel1)){
               $respuesta=$respuesta.'<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"  onclick="eliminar(`'.$r['id'].'`)">
               <i class="material-icons"  title="BORRAR"><img src="assets/icon/trashh.png"/></i>    
               </a>';
               
            }
            $respuesta=$respuesta.'</th>';
             $respuesta= $respuesta.'</tr>';

            }

           
            return $respuesta;
         
							
							


			
			
		}catch(Exception $e){
			
			return false;
		}
}

    private function existe($id){
		
		$co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		try{
			
			
			$resultado = $co->prepare("Select * from usuario where N_de_empleado =:id");
			
			$resultado->bindParam(':id',$id);
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
					$r=$co->prepare("Delete from usuarios 
						where
						id= :id
						");
					$r->bindParam(':id',$this->id);
					$r->execute();
                    $this->bitacora("se elimino un usuario", "usuarios",$this->nivel);
					return "Registro Eliminado";
                    
			} catch(Exception $e) {
				return $e->getMessage();
			}
			
		

		}
		else{
			return "Usuario no registrado";
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
    
    public function table_users(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co->prepare("
		SELECT id, nombre, cdt, rol
		FROM empleados
		ORDER BY nombre ASC;");

		$sql->execute();

		$tabla = '';

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$tabla .= '
        <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['nombre'] . '</td>
            <td>' . $row['cdt'] . '</td>
            <td>' . $row['rol'] . '</td>
            <td><button class="btn-modificar btn-sm" data-id="' . $row['id'] . '">Modificar</button></td>
            <td><button class="btn-eliminar btn-sm" data-id="' . $row['id'] . '">Eliminar</button></td>
        </tr>';
		}

        return $tabla;
    }

}

?>
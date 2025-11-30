<?php

require_once('modelo/conexion.php');
class seguridad extends datos{


 
    private $id;
	private $permiso;
	private $rol;
	private $descripcion;
    private $nivel;




    public function set_id($valor){
        if (preg_match("/^[a-zA-Z0-9\s]+$/", $valor)) {
		$this->id = $valor; 
        return true;
    }else{
        return false;
    }
 
	}
	public function set_permiso($valor){

		$this->permiso = $valor; 
   
	}
	public function set_rol($valor){
        if (preg_match("/^[a-zA-Z0-9\s]+$/", $valor)) {
		$this->rol = $valor; 
        return true;
        }else{
            return false;
        }
	}
	public function set_descripcion($valor){
        if (preg_match("/^[a-zA-Z0-9\s]+$/", $valor)) {
		$this->descripcion = $valor; 
        return true;
        }else{
            return false;
        }
	}
    public function set_nivel($valor){
		$this->nivel = $valor; 
	}

	
  
    
public function bitacora1($accion, $modulo,$id){
    $this->bitacora($accion, $modulo,$id);
}




//<!---------------------------------funcion registrar------------------------------------------------------------------>
    public function registrar(){

        $co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            try{
                $r= $co->prepare("Insert into rol_permiso(
						
                    ID_ROL,
                    ID_Permiso
                            )
            
                    Values( :id_rol,
                            :id_permiso
                    )"
                );

                $r->bindParam(':id_rol',$this->id);	
                $r->bindParam(':id_permiso',$this->permiso);		
               
            
             
                $r->execute();

                
                    return "Registro Incluido";	
                
            }catch(Exception $e){
                return $e->getMessage();
            }
       
  }



  public function registrar1(){


    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$this->existe($this->rol)){
        try{
            $estado=1;
            $r= $co->prepare("Insert into rol(
                    
                Nombre,
                Descripcion
                )
        

                Values(
                    :nombre,
                    :descripcion
                )");
            $r->bindParam(':nombre',$this->rol);	
            $r->bindParam(':descripcion',$this->descripcion);	
           
         
            $r->execute();

            $this->bitacora("se registro un rol", "seguridad",$this->nivel);
                return "Registro incluido";	
            
        }catch(Exception $e){
            return $e->getMessage();
        }
            
        }
        else{
            return "rol registrado";
        }









    }


  

 //<!---------------------------------fin de funcion registrar------------------------------------------------------------------>  
        








 






//<!---------------------------------funcion modificar------------------------------------------------------------------>
        public function modificar(){


            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($this->existe($this->rol)){
                try{
                    $r= $co->prepare("Update rol set 
                            
                       
                        Nombre=:nombre,
                        Descripcion=:descripcion
                        where
						Nombre =:nombre
                        
                
                         
                            
                            
                        ");
   	
                    $r->bindParam(':nombre',$this->rol);	
                    $r->bindParam(':descripcion',$this->descripcion);	
                    
                 
                    $r->execute();
    
                    $this->bitacora("se modifico un rol", "seguridad",$this->nivel);
                        return "Registro modificado";	
                    
                }catch(Exception $e){
                    return $e->getMessage();
                }
                    
                }
                else{
                    return "cedula no registrada";
                }
        

            }
  //<!---------------------------------fin de funcion modificar------------------------------------------------------------------>  




















  //<!---------------------------------funcion consultar------------------------------------------------------------------>          
public function consultar($nivel1){
    $co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
			
			
			$resultado = $co->prepare("SELECT * from rol");
			$resultado->execute();
           $respuesta="";

            foreach($resultado as $r){
                $respuesta= $respuesta.'<tr>';
                $respuesta=$respuesta."<th class='ocultar' style='display:none'>".$r['ID']."</th>";
                $respuesta=$respuesta."<th>".$r['Nombre']."</th>";
                $respuesta=$respuesta."<th>".$r['Descripcion']."</th>";  
             
                $respuesta=$respuesta.'<th>';
                if (in_array("modificar_permisos",$nivel1)) {
                $respuesta=$respuesta.'<button class="btn-modificar btn-sm" data-toggle="modal"
                                    data-target="#ModificarModal" onclick="modificar(`'.$r['ID'].'`)">Modificar</button>';
                }
                if (in_array("modificar_permisos",$nivel1)) {
            $respuesta=$respuesta.'<button class="btn-eliminar btn-sm" data-toggle="modal"
                                    data-target="#SetModal" id="asignar"  onclick="permisos(`'.$r['ID'].'`)" >Asignar</button>';
                }
                
            $respuesta=$respuesta.'</th>';
             $respuesta= $respuesta.'</tr>';

            }

           
            return $respuesta;
         
							
							


			
			
		}catch(Exception $e){
			
			return false;
		}
}








public function consultar1(){
    $co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
			
			
			$resultado = $co->prepare("SELECT p.nombre as permiso1 FROM rol r 
            INNER JOIN rol_permiso rp ON r.id=rp.id_rol INNER JOIN permisos p ON rp.id_permiso=p.id 
            WHERE r.id = :var
            ORDER BY rp.id_permiso");
            $resultado->bindParam(':var',$this->id);
			$resultado->execute();
        
            $respuesta="";

            foreach($resultado as $r){

                $respuesta= $respuesta.'<tr>';
                
                $respuesta=$respuesta."<th>".$r['permiso1']."</th>";
                
             $respuesta= $respuesta.'</tr>';

            }

           
            return $respuesta;
         
							
							


			
			
		}catch(Exception $e){
			
			return false;
		}
}


//<!---------------------------------fin funcion consultar------------------------------------------------------------------>



















//<!---------------------------------funcion existe------------------------------------------------------------------>
    private function existe($cedula){
		
		$co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		try{
			
			
			$resultado = $co->prepare("Select * from rol where nombre=:cedula");
			
			$resultado->bindParam(':cedula',$cedula);
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


    private function existe1($cedula){
		
		$co = $this->conecta();
		
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		try{
			
			
			$resultado = $co->prepare("Select * from rol where id=:cedula");
			
			$resultado->bindParam(':cedula',$cedula);
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
//<!---------------------------------fin de funcion existe------------------------------------------------------------------>















public function eliminar1(){
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    

        try {
                $r=$co->prepare("Delete from rol_permiso 
                    where
                    ID_ROL = :id_rol
                    ");
                $r->bindParam(':id_rol',$this->id);
                $r->execute();
                return "Registro Eliminado";
                
        } catch(Exception $e) {
            return $e->getMessage();
        }
        
    

   
}






//<!---------------------------------funcion eliminar------------------------------------------------------------------>
public function eliminar(){
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($this->existe1($this->id)){
    

        try {
                $r=$co->prepare("Delete from rol 
                    where
                    id= :id
                    ");
                $r->bindParam(':id',$this->id);
                $r->execute();
                $this->bitacora("se elimino un rol", "seguridad",$this->nivel);
                return "Registro Eliminado";
                
        } catch(Exception $e) {
            return $e->getMessage();
        }
        
    

    }
    else{
        return "rol no registrado";
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



}



//<!---------------------------------Fin de funcion eliminar------------------------------------------------------------------>
?>
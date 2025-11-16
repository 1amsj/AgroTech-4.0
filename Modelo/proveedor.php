<?php

require_once('modelo/conexion.php');
class entrada extends datos
{

	private $nombre;
	private $rol;
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
	public function set_descripcion($valor)
	{

		$this->contraseña = $valor;


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
				$r = $co->prepare("Insert into usuario(
						
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
				$r->bindParam(':N_de_empleado', $this->id);
				$r->bindParam(':nombre', $this->nombre);
				$r->bindParam(':apellido', $this->apellido);
				$r->bindParam(':contrasena', $this->contraseña);
				$r->bindParam(':estado', $t);
				$r->bindParam(':id_rol', $this->rol);
				$r->bindParam(':id_cdt', $this->cdt);
				$r->execute();
				$this->bitacora("se registro un usuario", "usuarios", $this->nivel);

				return "Registro incluido";

			} catch (Exception $e) {
				return $e->getMessage();
			}

		} else {
			return "nombre registrado";
		}


	}

	public function modificar1()
	{


		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($this->existe($this->id)) {
			try {
				$t = "1";
				$r = $co->prepare("Update usuario set 
                            
                       
                        N_de_empleado =:N_de_empleado,
                        
                        Nombre=:Nombre,
                        Apellido=:Apellido,
                        Contrasena=:Contrasena,
                        Estado=:Estado,
                        ID_rol =:ID_rol,
                        ID_CDT =:ID_CDT
                        where
						N_de_empleado =:N_de_empleado 
                            
                        ");
				$r->bindParam(':N_de_empleado', $this->id);
				$r->bindParam(':Nombre', $this->nombre);
				$r->bindParam(':Apellido', $this->apellido);
				$r->bindParam(':Contrasena', $this->contraseña);
				$r->bindParam(':Estado', $t);
				$r->bindParam(':ID_rol', $this->rol);
				$r->bindParam(':ID_CDT', $this->cdt);

				$r->execute();

				$this->bitacora("se modifico un usuario", "usuarios", $this->nivel);
				return "Registro modificado";

			} catch (Exception $e) {
				return $e->getMessage();
			}

		} else {
			return "el usuario no esta registrado";
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
					$r=$co->prepare("Update usuario set 
                        Estado=0
                        where
						N_de_empleado =:N_de_empleado 
                            
                        ");
					$r->bindParam(':N_de_empleado',$this->id);
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
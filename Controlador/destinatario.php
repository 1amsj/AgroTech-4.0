<?php 

if (!is_file("modelo/".$pagina.".php")){
	
	echo "Falta definir la clase ".$pagina;
	exit;
}
require_once("modelo/".$pagina.".php"); 


	if(is_file("vista/".$pagina.".php")){
		if(empty($_SESSION)){
			session_start();
			}
  
			  if(isset($_SESSION['usuario'])){
			   $nivel = $_SESSION['usuario'];
			}
			else{
				$nivel = "";
			}
			
	  
				  if(isset($_SESSION['permisos'])){
				   $nivel1 = $_SESSION['permisos'];
			  
				}
				else{
					$nivel1 = "";
				}

		$o = new destinatario();
		if(!empty($_POST)){
		
		  if(!empty($_POST['accion'])){


			$o->set_nombre($_POST['nombre'] ?? '');

			$o->set_apellido($_POST['apellido'] ?? '');


			$o->set_telefono($_POST['telefono'] ?? '');


			$o->set_descripcion($_POST['descripcion'] ?? '');

			$o->set_nivel($nivel);
			
			$mensaje = $o->registrar();	
			
				
			
			
		  }

		  if(!empty($_POST['modificar'])){



			$o->set_id($_POST['modificar']);
			$o->set_nombre($_POST['nombrem'] ?? '');

			$o->set_apellido($_POST['apellidom'] ?? '');

			$o->set_telefono($_POST['telefonom'] ?? '');
		
			$o->set_descripcion($_POST['descripcionm'] ?? '');

			$o->set_nivel($nivel);
			
			$mensaje = $o->modificar();	
			
				
			
			
		  }

		  if(!empty($_POST['eliminar'])){


			$o->set_id($_POST['eliminar']);
			$o->set_nivel($nivel);
			
			$mensaje = $o->eliminar();	
			
				
			
			
		  }
			
		}
		$consult = $o->consultar($nivel1);
		
		require_once("vista/".$pagina.".php");
	}
	else{
		echo "PAGINA EN CONSTRUCCION";
	}

?>
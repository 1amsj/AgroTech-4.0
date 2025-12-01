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

		$o = new inventario();
		if(!empty($_POST)){
		
		if(!empty($_POST['accion'])){


			$o->set_nombre($_POST['nombre']);

			$o->set_categoria($_POST['categoria']);
			
			$o->set_fecha($_POST['fecha']);
			
			$o->set_stocka($_POST['stocka']);

			$o->set_nivel($nivel);
			
			$mensaje = $o->registrar();	
			echo $mensaje;
			
				
			
			
		  }

		  if(!empty($_POST['modificar'])){



			$o->set_nombre($_POST['nombrem']);

			$o->set_categoria($_POST['categoriam']);

			$o->set_fecha($_POST['fecham']);

			$o->set_stocka($_POST['stockam']);

			$o->set_nivel($nivel);
			
			$mensaje = $o->modificar();	
			echo $mensaje;
			
				
			
			
		  }

		  if(!empty($_POST['eliminar'])){


			$o->set_nombre($_POST['eliminar']);

			$o->set_nivel($nivel);
			
			$mensaje = $o->eliminar();	
			echo $mensaje;
			
				
			
			
		  }
			
		}
		$consult = $o->consultar($nivel1);
		
		require_once("vista/".$pagina.".php");
	}
	else{
		echo "PAGINA EN CONSTRUCCION";
	}

?>
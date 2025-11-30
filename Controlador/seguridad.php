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




		
		$o = new seguridad();
	


		  if(!empty($_POST['id2'])){
			
				$o->set_id($_POST['id2']);
	
			

			$o->set_nivel($nivel);
			$o->eliminar1();
			
			if (!empty($_POST['exampleRadios'])) {
				$permiso=$_POST['exampleRadios'];
				$long= count($_POST['exampleRadios']);
				for ($i=0; $i < $long ; $i++) { 
					$o->set_permiso($permiso[$i]);
					$o->registrar();
					
				}

				
	
			}
			
			
			exit;			
		  }



		  if(!empty($_POST['id_rol'])){
			
			$o->set_id($_POST['id_rol']);
			$consultar1=$o->consultar1();
			echo $consultar1;
			exit;			
		  }






		  
		  if(!empty($_POST['rol'])){
			

			$o->set_descripcion($_POST['descripcion']);
			
			$o->set_rol($_POST['rol']);
			

			
			
			$o->set_nivel($nivel);
			
				$mensaje = $o->registrar1();	
				echo $mensaje;
			
		  }


		  if(!empty($_POST['descripcion1'])){
		
	
			$valor=true;
			$retorno="";

			$o->set_descripcion($_POST['descripcion1']);
			
			$o->set_rol($_POST['rol1']);
			

			
			
			$o->set_nivel($nivel);
			
			
				$mensaje = $o->modificar();	
				echo $mensaje;
					
		  }

		  


		  if(!empty($_POST['accion3'])){
		
			$valor=true;
			$retorno="";

			$validacion[0]=$o->set_id($_POST['cedula2']);
			$dato[0]="error en la validacion del cedula2";
			

			
			
			$o->set_nivel($nivel);
			
			for ($i=0; $i <= 0 ; $i++) { 
				if ($validacion[$i]== false) {
					$retorno=$retorno.$dato[$i]."<br>";
					$valor=false;
				}
			}

			if ($valor==true) {
				$mensaje = $o->eliminar();	
				echo $mensaje;
			}else{
				echo $retorno;
			}
			
			exit;					
		  }





		  if(!empty($_POST['consulta'])){
	
			if(isset($_SESSION['permisos'])){
				$nivel1 = $_SESSION['permisos'];
		   
			 }
			 else{
				 $nivel1 = "";
			 }
			
			
			$consuta=$o->consultar($nivel1);
			
			echo $consuta;
			exit;
		  }

		 
		  $consuta=$o->consultar($nivel1);
		require_once("vista/".$pagina.".php");



	}else{
		echo "PAGINA EN CONSTRUCCION";
	}

?>
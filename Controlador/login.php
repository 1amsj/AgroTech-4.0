<?php 

if (!is_file("modelo/".$pagina.".php")){
	
	echo "Falta definir la clase ".$pagina;
	exit;
}
require_once("modelo/".$pagina.".php"); 


	if(is_file("vista/".$pagina.".php")){

		
		if(!empty($_POST)){

			$o = new entrada();
			
				$o->set_usuario($_POST['user']);
			
			
			
			$mensaje="";
			
			$resultado = $o->busca();
			$entrada= true;
			if(empty($resultado[1])){
				$entrada= false;
				$mensaje="El usuario ingresado es incorrecto";
				echo $mensaje;
				
				
			}
			
			
			if($mensaje==""){

				if (!$_POST['password']==$resultado[0]) {
					$entrada= false;
					$mensaje="La contraceña ingresada es incorrecta";
					echo $mensaje;
				}

			}
			

			if($entrada){
				$permisos=$o->permisos($resultado[1]);
				if ($permisos!="ha ocurrido un error") {
					session_start();
					
					$_SESSION['usuario'] = $_POST['user'];
					$_SESSION['usuario_nombre'] = $resultado[2];
					$_SESSION['rol'] = $resultado[1];
					$_SESSION['permisos'] =$permisos;
					$pagina="main";
					
				}else{
					echo $permisos;
				}
				
			}
			
			
		  }
		




		require_once("vista/".$pagina.".php");
	}
	else{
		echo "PAGINA EN CONSTRUCCION";
	}

?>
<?php

if (!is_file("modelo/" . $pagina . ".php")) {

	echo "Falta definir la clase " . $pagina;
	exit;
}
require_once("modelo/" . $pagina . ".php");


if (is_file("vista/" . $pagina . ".php")) {
	if (empty($_SESSION)) {
		session_start();
	}

	if (isset($_SESSION['usuario'])) {
		$nivel = $_SESSION['usuario'];
	} else {
		$nivel = "";
	}


	if (isset($_SESSION['permisos'])) {
		$nivel1 = $_SESSION['permisos'];

	} else {
		$nivel1 = "";
	}


	if (!empty($_POST)) {
		$o = new usuarios();
		if (!empty($_POST['accion'])) {


			$valor = true;
			$retorno = "";
			$o->set_user($_POST['user']);

			$o->set_nombre($_POST['nombre']);

			$o->set_apellido($_POST['apellido']);

			$o->set_cdt($_POST['cdt']);

			$o->set_rol($_POST['rol']);

			$o->set_contraceña($_POST['contraseña']);

			$o->set_nivel($nivel);

			$mensaje = $o->registrar();
			echo $mensaje;

			$roles = $o->roles();
		$cdt = $o->cdt();
		$tabla = $o->table_users();


		}
		
	}


	require_once("vista/" . $pagina . ".php");
} else {
	echo "PAGINA EN CONSTRUCCION";
}

?>
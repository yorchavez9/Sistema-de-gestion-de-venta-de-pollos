<?php

class ControladorRoles
{



	/*=============================================
	REGISTRO DE ROLES
	=============================================*/

	static public function ctrCrearRoles()
	{



		$tabla = "roles";

		$datos = array(
			"nombre_rol" => $_POST["nombre_rol"]
		);

		$respuesta = ModeloRol::mdlIngresarRol($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		} else {
			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR ROLES
	=============================================*/

	static public function ctrMostrarRol($item, $valor)
	{

		$tabla = "roles";

		$respuesta = ModeloRol::mdlMostrarRoles($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR ROL
	=============================================*/

	static public function ctrEditarRol()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre_rol"])) {

			$tabla = "roles";

			$datos = array(
				"id_rol" => $_POST["edit_id_rol"],
				"nombre_rol" => $_POST["edit_nombre_rol"]
			);

			$respuesta = ModeloRol::mdlEditarRol($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR ROL
	=============================================*/

	static public function ctrBorraRol()
	{

		if (isset($_POST["deleteIdRol"])) {

			$tabla = "roles";

			$datos = $_POST["deleteIdRol"];

			$respuesta = ModeloRol::mdlBorrarRol($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

<?php

class ControladorVacaciones{


	/*=============================================
	REGISTRO DE VACACIONES
	=============================================*/

	static public function ctrCrearVacaciones()
	{

		$tabla = "vacaciones";

		$datos = array(
			"id_trabajador" => $_POST["id_trabajador"],
			"fecha_inicio" => $_POST["fecha_inicio"],
			"fecha_fin" => $_POST["fecha_fin"]
		);

		$respuesta = ModeloVacaciones::mdlIngresarVacacion($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");

		} else {

			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR VACACIONES
	=============================================*/

	static public function ctrMostrarVacacion($item, $valor)
	{

		$tablaT = "trabajadores";

		$tablaV = "vacaciones";

		$respuesta = ModeloVacaciones::mdlMostrarVacaciones($tablaT, $tablaV, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR VACACIONES
	=============================================*/

	static public function ctrEditarVacacion()
	{



		$tabla = "vacaciones";

		$datos = array(
			"id_vacacion" => $_POST["edit_id_vacaciones"],
			"id_trabajador" => $_POST["edit_id_trabajador_v"],
			"fecha_inicio" => $_POST["edit_fecha_inicio_v"],
			"fecha_fin" => $_POST["edit_fecha_fin_v"]
		);

		$respuesta = ModeloVacaciones::mdlEditarVacacion($tabla, $datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");

		} else {

			echo json_encode("error");
		}
	}

	/*=============================================
	BORRAR VACACIONES
	=============================================*/

	static public function ctrBorrarVacacion()
	{

		if (isset($_POST["idVacacionDelete"])) {

			$tabla = "vacaciones";

			$datos = $_POST["idVacacionDelete"];

			$respuesta = ModeloVacaciones::mdlBorrarVacacion($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

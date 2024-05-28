<?php

class ControladorImpresora
{



	/*=============================================
	REGISTRO DE IMPRESORA
	=============================================*/

	static public function ctrCrearImpresora()
	{


		$tabla = "impresora";

		$datos = array(
			"nombre" => $_POST["nombre_impresora"],
			"ip_impresora" => $_POST["ip_impresora"]
		);

		$respuesta = ModeloImpresora::mdlIngresarImpresora($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		} else {
			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR IMPRESORA
	=============================================*/

	static public function ctrMostrarImpresora($item, $valor)
	{

		$tabla = "impresora";

		$respuesta = ModeloImpresora::mdlMostrarImpresora($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR IMPRESORA
	=============================================*/

	static public function ctrEditarImpresora()
	{

		$tabla = "impresora";

		$datos = array(
			"id_impresora" => $_POST["id_impresora_edit"],
			"nombre" => $_POST["edit_nombre_impresora"],
			"ip_impresora" => $_POST["edit_ip_impresora"]
		);

		$respuesta = ModeloImpresora::mdlEditarImpresora($tabla, $datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR IMPRESORA
	=============================================*/

	static public function ctrBorraImpresora()
	{

		if (isset($_POST["idImpresoraDelete"])) {

			$tabla = "impresora";

			$datos = $_POST["idImpresoraDelete"];
			
			

			$respuesta = ModeloImpresora::mdlBorrarImpresora($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

<?php

class ControladorProveedores
{



	/*=============================================
	REGISTRO DE PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedor()
	{



		$tabla = "personas";

		$datos = array(
			"tipo_persona" => $_POST["tipo_persona"],
			"razon_social" => $_POST["razon_social"],
			"id_doc" => $_POST["id_doc"],
			"numero_documento" => $_POST["numero_documento"],
			"direccion" => $_POST["direccion"],
			"ciudad" => $_POST["ciudad"],
			"codigo_postal" => $_POST["codigo_postal"],
			"telefono" => $_POST["telefono"],
			"email" => $_POST["email"],
			"sitio_web" => $_POST["sitio_web"],
			"tipo_banco" => $_POST["tipo_banco"],
			"numero_cuenta" => $_POST["numero_cuenta"]
		);

		$respuesta = ModeloProveedor::mdlIngresarProveedor($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		} else {
			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function ctrMostrarProveedor($item, $valor)
	{

		$tablaDoc = "tipo_documentos";
		$tablaPer = "personas";

		$respuesta = ModeloProveedor::mdlMostrarProveedor($tablaDoc, $tablaPer, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedor()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_razon_social"])) {

			$tabla = "personas";

			$datos = array(
				"id_persona" => $_POST["edit_id_proveedor"],
				"razon_social" => $_POST["edit_razon_social"],
				"id_doc" => $_POST["edit_id_doc"],
				"numero_documento" => $_POST["edit_numero_documento"],
				"direccion" => $_POST["edit_direccion"],
				"ciudad" => $_POST["edit_ciudad"],
				"codigo_postal" => $_POST["edit_codigo_postal"],
				"telefono" => $_POST["edit_telefono"],
				"email" => $_POST["edit_email"],
				"sitio_web" => $_POST["edit_sitio_web"],
				"tipo_banco" => $_POST["edit_tipo_banco"],
				"numero_cuenta" => $_POST["edit_numero_cuenta"]
			);

			$respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function ctrBorraProveedor()
	{

		if (isset($_POST["deleteIdProveedor"])) {

			$tabla = "personas";

			$datos = $_POST["deleteIdProveedor"];
			
			

			$respuesta = ModeloProveedor::mdlBorrarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

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
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre"])) {



			$tabla = "usuarios";

			if ($_POST["edit_contrasena"] != "") {

				$encriptar = crypt($_POST["edit_contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			} else {

				$encriptar = $_POST["edit_actualContrasena"];
			}

			$datos = array(
				"id_usuario" => $_POST["edit_idUsuario"],
				"nombre_usuario" => $_POST["edit_nombre"],
				"id_doc" => $_POST["edit_tipoDocumento"],
				"numero_documento" => $_POST["edit_numeroDocumento"],
				"direccion" => $_POST["edit_direccion"],
				"telefono" => $_POST["edit_telefono"],
				"correo" => $_POST["edit_correo"],
				"usuario" => $_POST["edit_usuario"],
				"contrasena" => $encriptar
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

		if (isset($_POST["deleteUserId"])) {

			$tabla = "usuarios";

			$datos = $_POST["deleteUserId"];

			if ($_POST["deleteRutaUser"] != "") {
				// Verificar si el archivo existe y eliminarlo
				if (file_exists($_POST["deleteRutaUser"])) {
					unlink($_POST["deleteRutaUser"]);
				} else {
					// El archivo no existe
					echo "El archivo a eliminar no existe.";
				}
			}
			
			

			$respuesta = ModeloProveedor::mdlBorrarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

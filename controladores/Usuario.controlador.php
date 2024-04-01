<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


				$tablaDoc = "tipo_documentos";
				$tablaUser = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tablaDoc, $tablaUser, $item, $valor);

				if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["contrasena"] == $encriptar) {
					
					if ($respuesta["estado"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id_usuario"] = $respuesta["id_usuario"];
						$_SESSION["nombre_usuario"] = $respuesta["nombre_usuario"];
						$_SESSION["id_doc"] = $respuesta["id_doc"];
						$_SESSION["numero_documento"] = $respuesta["numero_documento"];
						$_SESSION["direccion"] = $respuesta["direccion"];
						$_SESSION["telefono"] = $respuesta["telefono"];
						$_SESSION["correo"] = $respuesta["correo"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["imagen_usuario"] = $respuesta["imagen_usuario"];
						$_SESSION["roles"] = $respuesta["roles"];


						echo '<script>
							window.location = "inicio"
						</script>';
					} else {

						echo json_encode("El usuario aún no está activado");
					}
				} else {


					$mensajeError = "Error al ingresar, vuelve a intentarlo";
					echo json_encode($mensajeError);
				}
			}
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{


		/* VALIDANDO IMAGEN */

		$ruta = "../vistas/img/usuarios/";

		if (isset($_FILES["imagen"]["tmp_name"])) {

			$extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);

			$tipos_permitidos = array("jpg", "jpeg", "png", "gif");

			if (in_array(strtolower($extension), $tipos_permitidos)) {

				$nombre_imagen = date("YmdHis") . rand(1000, 9999);

				$ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

				if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen)) {

					/* echo "Imagen subida correctamente."; */
				} else {

					/* echo "Error al subir la imagen."; */
				}
			} else {

				/* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
			}
		}


		$tabla = "usuarios";

		$encriptar = crypt($_POST["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$datos = array(
			"nombre_usuario" => $_POST["nombre"],
			"id_doc" => $_POST["tipoDocumento"],
			"numero_documento" => $_POST["numeroDocumento"],
			"direccion" => $_POST["direccion"],
			"telefono" => $_POST["telefono"],
			"correo" => $_POST["correo"],
			"usuario" => $_POST["usuario"],
			"contrasena" => $encriptar,
			"imagen_usuario" => $ruta_imagen,
			"roles" => $_POST["data_roles"]
		);

		$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		} else {
			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tablaDoc = "tipo_documentos";
		$tablaUser = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tablaDoc, $tablaUser, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre"])) {

			/* ============================
            VALIDANDO IMAGEN
            ============================ */

            $ruta = "../vistas/img/usuarios/";

            $ruta_imagen = $_POST["edit_imagenActualUsuario"];

            if (isset($_FILES["edit_imagen"]["tmp_name"]) && !empty($_FILES["edit_imagen"]["tmp_name"])) {

                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }

                $extension = pathinfo($_FILES["edit_imagen"]["name"], PATHINFO_EXTENSION);

                $tipos_permitidos = array("jpg", "jpeg", "png", "gif");

                if (in_array(strtolower($extension), $tipos_permitidos)) {

                    $nombre_imagen = date("YmdHis") . rand(1000, 9999);

                    $ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

                    if (move_uploaded_file($_FILES["edit_imagen"]["tmp_name"], $ruta_imagen)) {

                        /* echo "Imagen subida correctamente."; */
                    } else {

                        /* echo "Error al subir la imagen."; */
                    }
                } else {

                    /* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
                }
            }



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
				"contrasena" => $encriptar,
				"imagen_usuario" => $ruta_imagen,
				"roles" => $_POST["data_roles"]
			);

			$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario()
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
			
			

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

<?php

class ControladorTrabajador
{


	/*=============================================
	REGISTRO DE TRABAJADOR
	=============================================*/

	static public function ctrCrearTrabajador()
	{


		/* VALIDANDO FOTO DEL TRABAJADOR */

		$ruta = "../vistas/img/trabajador/";

        $ruta_imagen = "";
        
		if (isset($_FILES["foto"]["tmp_name"])) {

			$extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

			$tipos_permitidos = array("jpg", "jpeg", "png", "gif");

			if (in_array(strtolower($extension), $tipos_permitidos)) {

				$nombre_imagen = date("YmdHis") . rand(1000, 9999);

				$ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_imagen)) {

					/* echo "Imagen subida correctamente."; */
				} else {

					/* echo "Error al subir la imagen."; */
				}
			} else {

				/* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
			}
		}





		/* VALIDANDO CV PDF DEL TRABAJADOR */

		$ruta = "../vistas/pdf/trabajador/";

        $ruta_cv = "";
        
		if (isset($_FILES["cv"]["tmp_name"])) {

			$extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);

			$tipos_permitidos = array("pdf");

			if (in_array(strtolower($extension), $tipos_permitidos)) {

				$nombre_imagen = date("YmdHis") . rand(1000, 9999);

				$ruta_cv = $ruta . $nombre_imagen . "." . $extension;

				if (move_uploaded_file($_FILES["cv"]["tmp_name"], $ruta_cv)) {

					/* echo "Imagen subida correctamente."; */
				} else {

					/* echo "Error al subir la imagen."; */
				}
			} else {

				/* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
			}
		}


		$tabla = "trabajadores";


		$datos = array(
			"nombre" => $_POST["nombre"],
			"num_documento" => $_POST["num_documento"],
			"telefono" => $_POST["telefono"],
			"correo" => $_POST["correo"],
			"foto" => $ruta_imagen,
			"cv" => $ruta_cv,
			"tipo_pago" => $_POST["tipo_pago"],
			"num_cuenta" => $_POST["num_cuenta"]
		);


		$respuesta = ModeloTrabajador::mdlIngresarTrabajador($tabla, $datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
            
		} else {

			echo json_encode("error");

		}
	}

	/*=============================================
	MOSTRAR TRABAJADORES
	=============================================*/

	static public function ctrMostrarTrabajadores($item, $valor)
	{

		$tabla = "trabajadores";

		$respuesta = ModeloTrabajador::mdlMostrarTrabajadores($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR TRABAJADORES
	=============================================*/

	static public function ctrMostrarTrabajadoresAsistencia($item, $valor)
	{

		$tabla = "trabajadores";

		$respuesta = ModeloTrabajador::mdlMostrarTrabajadoresAsistencia($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR TRABAJADOR
	=============================================*/

	static public function ctrEditarTrabajador()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre_t"])) {

            

			/* VALIDANDO FOTO */

            $ruta = "../vistas/img/trabajador/";

            $ruta_foto = $_POST["foto_actual_t"];

            if (isset($_FILES["edit_foto_t"]["tmp_name"]) && !empty($_FILES["edit_foto_t"]["tmp_name"])) {

                if (file_exists($ruta_foto)) {
                    unlink($ruta_foto);
                }

                $extension = pathinfo($_FILES["edit_foto_t"]["name"], PATHINFO_EXTENSION);

                $tipos_permitidos = array("jpg", "jpeg", "png", "gif");

                if (in_array(strtolower($extension), $tipos_permitidos)) {

                    $nombre_imagen = date("YmdHis") . rand(1000, 9999);

                    $ruta_foto = $ruta . $nombre_imagen . "." . $extension;

                    if (move_uploaded_file($_FILES["edit_foto_t"]["tmp_name"], $ruta_foto)) {

                        /* echo "Imagen subida correctamente."; */
                    } else {

                        /* echo "Error al subir la imagen."; */
                    }
                } else {

                    /* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
                }
            }




			/* VALIDANDO CV PDF */

            $ruta = "../vistas/pdf/trabajador/";

            $ruta_cv = $_POST["cv_actual_t"];

            if (isset($_FILES["edit_cv_t"]["tmp_name"]) && !empty($_FILES["edit_cv_t"]["tmp_name"])) {

                if (file_exists($ruta_cv)) {
                    unlink($ruta_cv);
                }

                $extension = pathinfo($_FILES["edit_cv_t"]["name"], PATHINFO_EXTENSION);

                $tipos_permitidos = array("pdf");

                if (in_array(strtolower($extension), $tipos_permitidos)) {

                    $nombre_pdf = date("YmdHis") . rand(1000, 9999);

                    $ruta_cv = $ruta . $nombre_pdf . "." . $extension;

                    if (move_uploaded_file($_FILES["edit_cv_t"]["tmp_name"], $ruta_cv)) {

                        /* echo "Imagen subida correctamente."; */
                    } else {

                        /* echo "Error al subir la imagen."; */
                    }
                } else {

                    /* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
                }
            }



			$tabla = "trabajadores";

			$datos = array(
				"id_trabajador" => $_POST["edit_id_trabajador"],
				"nombre" => $_POST["edit_nombre_t"],
				"num_documento" => $_POST["edit_numero_documento_t"],
				"telefono" => $_POST["edit_telefono_t"],
				"correo" => $_POST["edit_correo_t"],
				"foto" => $ruta_foto,
				"cv" => $ruta_cv,
				"tipo_pago" => $_POST["edit_tipo_pago_t"],
				"num_cuenta" => $_POST["edit_numero_cuenta"]
			);


			$respuesta = ModeloTrabajador::mdlEditarTrabajador($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR TRABAJADOR
	=============================================*/

	static public function ctrBorrarTrabajador()
	{

		if (isset($_POST["deleleteIdTrabajador"])) {

			$tabla = "trabajadores";

			$datos = $_POST["deleleteIdTrabajador"];

			if ($_POST["deleteRutaFoto"] != "") {
				// Verificar si el archivo existe y eliminarlo
				if (file_exists($_POST["deleteRutaFoto"])) {
					unlink($_POST["deleteRutaFoto"]);
				} else {
					// El archivo no existe
					echo "El archivo a eliminar no existe.";
				}
			}
			

			if ($_POST["deleteRutaCv"] != "") {
				// Verificar si el archivo existe y eliminarlo
				if (file_exists($_POST["deleteRutaCv"])) {
					unlink($_POST["deleteRutaCv"]);
				} else {
					// El archivo no existe
					echo "El archivo a eliminar no existe.";
				}
			}
			
			

			$respuesta = ModeloTrabajador::mdlBorrarTrabajador($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

<?php

class ControladorConfiguracionTicket
{


	/*=============================================
	REGISTRO DE CONFIGURACION TICKET
	=============================================*/

	static public function ctrCrearConfiguracionTicket()
	{


		/* VALIDANDO IMAGEN LOGO */

		$ruta = "../vistas/img/ticket/";

		if (isset($_FILES["logo_ticket"]["tmp_name"])) {

			$extension = pathinfo($_FILES["logo_ticket"]["name"], PATHINFO_EXTENSION);

			$tipos_permitidos = array("jpg", "jpeg", "png", "gif");

			if (in_array(strtolower($extension), $tipos_permitidos)) {

				$nombre_imagen = date("YmdHis") . rand(1000, 9999);

				$ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

				if (move_uploaded_file($_FILES["logo_ticket"]["tmp_name"], $ruta_imagen)) {

					/* echo "Imagen subida correctamente."; */
				} else {

					/* echo "Error al subir la imagen."; */
				}
			} else {

				/* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
			}
		}


		$tabla = "config_ticket";


		$datos = array(
			"nombre_empresa" => $_POST["nombre_empresa_ticket"],
			"telefono" => $_POST["telefono_ticket"],
			"correo" => $_POST["correo_ticket"],
			"direccion" => $_POST["direccion_ticket"],
			"logo" => $ruta_imagen,
			"mensaje" => $_POST["mensaje_ticket"]
		);


        $respuesta = ModeloConfiguracionTicket::mdlIngresarConfiguracionTicket($tabla, $datos);

        if ($respuesta == "ok") {

            $response = array(
                "mensaje" => "Configuracion ticket guardado correctamente",
                "estado" => "ok"
            );

            echo json_encode($response);

        } else {

            $response = array(
                "mensaje" => "Error al guardar la configuración",
                "estado" => "error"
            );

            echo json_encode($response);

        }
    }

	/*=============================================
	MOSTRAR PRODUCTO
	=============================================*/

	static public function ctrMostrarConfiguracionTicket($item, $valor)
	{

		$tabla = "config_ticket";

		$respuesta = ModeloConfiguracionTicket::mdlMostrarConfiguracionTicket($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	EDITAR CONFIGURACION TICKET
	=============================================*/

	static public function ctrEditarConfiguracionTicket()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre_empresa_ticket"])) {

			/* ============================
            VALIDANDO IMAGEN
            ============================ */

            $ruta = "../vistas/img/ticket/";

            $ruta_imagen = $_POST["edit_foto_actual_ticket"];

            if (isset($_FILES["edit_logo_ticket"]["tmp_name"]) && !empty($_FILES["edit_logo_ticket"]["tmp_name"])) {

                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }

                $extension = pathinfo($_FILES["edit_logo_ticket"]["name"], PATHINFO_EXTENSION);

                $tipos_permitidos = array("jpg", "jpeg", "png", "gif");

                if (in_array(strtolower($extension), $tipos_permitidos)) {

                    $nombre_imagen = date("YmdHis") . rand(1000, 9999);

                    $ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

                    if (move_uploaded_file($_FILES["edit_logo_ticket"]["tmp_name"], $ruta_imagen)) {

                        /* echo "Imagen subida correctamente."; */
                    } else {

                        /* echo "Error al subir la imagen."; */
                    }
                } else {

                    /* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
                }
            }



			$tabla = "config_ticket";


            $datos = array(
                "id_config_ticket" => $_POST["edit_id_config_ticket"],
                "nombre_empresa" => $_POST["edit_nombre_empresa_ticket"],
                "telefono" => $_POST["edit_telefono_ticket"],
                "correo" => $_POST["edit_correo_ticket"],
                "direccion" => $_POST["edit_direccion_ticket"],
                "logo" => $ruta_imagen,
                "mensaje" => $_POST["edit_mensaje_ticket"]
            );
    

			$respuesta = ModeloConfiguracionTicket::mdlEditarConfiguracionTicket($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("error");
		}
	}

	/*=============================================
	BORRAR CONFIGURACION TICKET
	=============================================*/

	static public function ctrBorrarConfiguracionTicket()
	{

		if (isset($_POST["idTicketDelete"])) {

			$tabla = "config_ticket";

			$datos = $_POST["idTicketDelete"];

			if ($_POST["rutaDeleteImagen"] != "") {

				// Verificar si el archivo existe y eliminarlo

				if (file_exists($_POST["rutaDeleteImagen"])) {

					unlink($_POST["rutaDeleteImagen"]);

				} else {

					// El archivo no existe
					echo "El archivo a eliminar no existe.";

				}

			}
			
			

			$respuesta = ModeloConfiguracionTicket::mdlBorrarConfiguracionTicket($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

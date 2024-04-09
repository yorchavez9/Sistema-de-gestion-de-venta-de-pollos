<?php

class ControladorListaCompra
{


	/*=============================================
	REGISTRO DE EGRESO
	=============================================*/

	static public function ctrCrearProducto()
	{


		/* VALIDANDO IMAGEN */

		$ruta = "../vistas/img/productos/";

		if (isset($_FILES["imagen_producto"]["tmp_name"])) {

			$extension = pathinfo($_FILES["imagen_producto"]["name"], PATHINFO_EXTENSION);

			$tipos_permitidos = array("jpg", "jpeg", "png", "gif");

			if (in_array(strtolower($extension), $tipos_permitidos)) {

				$nombre_imagen = date("YmdHis") . rand(1000, 9999);

				$ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

				if (move_uploaded_file($_FILES["imagen_producto"]["tmp_name"], $ruta_imagen)) {

					/* echo "Imagen subida correctamente."; */
				} else {

					/* echo "Error al subir la imagen."; */
				}
			} else {

				/* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
			}
		}


		$tabla = "productos";


		$datos = array(
			"id_categoria" => $_POST["id_categoria_P"],
			"codigo_producto" => $_POST["codigo_producto"],
			"nombre_producto" => $_POST["nombre_producto"],
			"stock_producto" => $_POST["stock_producto"],
			"fecha_vencimiento" => $_POST["fecha_vencimiento"],
			"descripcion_producto" => $_POST["descripcion_producto"],
			"imagen_producto" => $ruta_imagen
		);

        $respuesta = ModeloListaCompra::mdlIngresarEgreso($tabla, $datos);

        if ($respuesta == "ok") {

            $response = array(
                "mensaje" => "Producto guardado correctamente",
                "estado" => "ok"
            );

            echo json_encode($response);

        } else {

            $response = array(
                "mensaje" => "Error al guardar el producto",
                "estado" => "error"
            );

            echo json_encode($response);

        }
    }

	/*=============================================
	ACTUALIZAR EL PAGO DE DEUDA EGRESO
	=============================================*/
	static public function ctrActualizarDeudaEgreso(){

		$tabla = "egresos";

		$totalPago = number_format($_POST["monto_pagar_compra"], 2, '.', '');

		$datos = array(
			"id_egreso" => $_POST["id_egreso_pagar"],
			"total_pago" => $totalPago
		);

        $respuesta = ModeloListaCompra::mdlActualizarPagoPendiente($tabla, $datos);

        if ($respuesta == "ok") {

            echo json_encode($respuesta);

        } else {

            echo json_encode($respuesta);

        }

	}

	/*=============================================
	MOSTRAR EGRESO
	=============================================*/

	static public function ctrMostrarListaEgreso($item, $valor)
	{

		$tablaD = "detalle_egreso";
		$tablaE = "egresos";
		$tablaP = "personas";

		$respuesta = ModeloListaCompra::mdlMostrarEgreso($tablaD, $tablaE, $tablaP, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR EGRESO
	=============================================*/

	static public function ctrEditarProducto()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre_producto"])) {

			/* ============================
            VALIDANDO IMAGEN
            ============================ */

            $ruta = "../vistas/img/productos/";

            $ruta_imagen = $_POST["edit_imagen_actual_p"];

            if (isset($_FILES["edit_imagen_producto"]["tmp_name"]) && !empty($_FILES["edit_imagen_producto"]["tmp_name"])) {

                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }

                $extension = pathinfo($_FILES["edit_imagen_producto"]["name"], PATHINFO_EXTENSION);

                $tipos_permitidos = array("jpg", "jpeg", "png", "gif");

                if (in_array(strtolower($extension), $tipos_permitidos)) {

                    $nombre_imagen = date("YmdHis") . rand(1000, 9999);

                    $ruta_imagen = $ruta . $nombre_imagen . "." . $extension;

                    if (move_uploaded_file($_FILES["edit_imagen_producto"]["tmp_name"], $ruta_imagen)) {

                        /* echo "Imagen subida correctamente."; */
                    } else {

                        /* echo "Error al subir la imagen."; */
                    }
                } else {

                    /* echo "Solo se permiten archivos de imagen JPG, JPEG, PNG o GIF."; */
                }
            }



			$tabla = "productos";


			$datos = array(
				"id_producto" => $_POST["edit_id_producto"],
				"id_categoria" => $_POST["edit_id_categoria_p"],
				"codigo_producto" => $_POST["edit_codigo_producto"],
				"nombre_producto" => $_POST["edit_nombre_producto"],
				"stock_producto" => $_POST["edit_stock_producto"],
				"fecha_vencimiento" => $_POST["edit_fecha_vencimiento"],
				"descripcion_producto" => $_POST["edit_descripcion_producto"],
				"imagen_producto" => $ruta_imagen
			);

			$respuesta = ModeloListaCompra::mdlEditarEgreso($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("error");
		}
	}

	/*=============================================
	BORRAR EGRESO
	=============================================*/

	static public function ctrBorrarProducto()
	{

		if (isset($_POST["idProductoDelete"])) {

			$tabla = "productos";

			$datos = $_POST["idProductoDelete"];

			if ($_POST["deleteRutaImagenProducto"] != "") {
				// Verificar si el archivo existe y eliminarlo
				if (file_exists($_POST["deleteRutaImagenProducto"])) {
					unlink($_POST["deleteRutaImagenProducto"]);
				} else {
					// El archivo no existe
					echo "El archivo a eliminar no existe.";
				}
			}
			
			

			$respuesta = ModeloListaCompra::mdlBorrarEgreso($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

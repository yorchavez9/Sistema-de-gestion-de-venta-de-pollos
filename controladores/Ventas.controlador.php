<?php

class ControladorVenta
{

	/*=============================================
	MOSTRAR VENTA
	=============================================*/

	static public function ctrMostrarVentas($item, $valor)
	{

		$tablaE = "egresos";
		$tablaDE = "detalle_egreso";

		$respuesta = ModeloVenta::mdlMostrarVenta($tablaE, $tablaDE, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR LISTA VENTAS
	=============================================*/

	static public function ctrMostrarListaVentas($item, $valor)
	{

		$tablaD = "detalle_venta";
		$tablaV = "ventas";
		$tablaP = "personas";

		$respuesta = ModeloVenta::mdlMostrarListaVenta($tablaD, $tablaV, $tablaP, $item, $valor);

		return $respuesta;
	}



	/*=============================================
	MOSTRAR SERIE NUMERO COMPRA
	=============================================*/

	static public function ctrMostrarSerieNumero($item, $valor)
	{

		$tabla = "ventas";

		$respuesta = ModeloVenta::mdlMostrarSerieNumero($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function ctrCrearVenta()
	{



		$tabla = "ventas";

		$pago_total = 0;

		if($_POST["tipo_pago"] == "contado"){

			$pago_total = $_POST["total"];

		}else{
			$pago_total = 0;
		}

		


		$datos = array(
			"id_persona" => $_POST["id_cliente_venta"],
			"id_usuario" => $_POST["id_usuario_venta"],
			"fecha_venta" => $_POST["fecha_venta"],
			"tipo_comprobante" => $_POST["comprobante_venta"],
			"serie_comprobante" => $_POST["serie_venta"],
			"num_comprobante" => $_POST["numero_venta"],
			"impuesto" => $_POST["igv_venta"],
			"total_venta" => $_POST["total"],
			"total_pago" => $pago_total,
			"sub_total" => $_POST["subtotal"],
			"igv" => $_POST["igv"],
			"tipo_pago" => $_POST["tipo_pago"],
			"estado_pago" => $_POST["estado_pago"],
			"pago_e_y" => $_POST["pago_e_y"]
		);


		$respuesta = ModeloVenta::mdlIngresarVenta($tabla, $datos);


		/* MOSTRANDO EL ULTIMO ID INGRESADO */

		$tabla = "ventas";

		$item = null;

		$valor = null;

		$respuestaDetalleVenta = ModeloVenta::mdlMostrarIdVenta($tabla, $item, $valor);

		foreach ($respuestaDetalleVenta as $value) {

			$id_venta_ultimo = $value["id_venta"];
		}



		/* ==========================================
		INGRESO DE DATOS AL DETALLE VENTA
		========================================== */
		$tblDetalleVenta = "detalle_venta";

		$productos = json_decode($_POST["productoAddVenta"], true);

		$datos = array();

		foreach ($productos as $dato) {
			$nuevo_dato = array(
				'id_venta' => $id_venta_ultimo,
				'id_producto' => $dato['id_producto'],
				'precio_venta' => $dato['precio_venta'],
				'cantidad_u' => $dato['cantidad_u'],
				'cantidad_kg' => $dato['cantidad_kg']
			);

			$datos[] = $nuevo_dato;

			 $respuestaDatos = ModeloVenta::mdlIngresarDetalleVenta($tblDetalleVenta, $nuevo_dato);

		}

		/* ==========================================
		ACTUALIZANDO EL STOCK DEL PRODUCTO
		========================================== */

		$tblProducto = "productos";

		$stocks = json_decode($_POST["productoAddVenta"], true);

		foreach ($stocks as $value) {
			
			$idProducto = $value['id_producto'];
			$cantidad = $value['cantidad_u'];

			// Actualizar el stock del producto
			$respStock = ModeloVenta::mdlActualizarStockProducto($tblProducto, $idProducto, $cantidad);
		}




		
		if ($respuestaDatos == "ok") {

            $response = array(
                "mensaje" => "La venta se realizó con éxito",
                "estado" => "ok"
            );

            echo json_encode($response);

        } else {

            $response = array(
                "mensaje" => "Error al realizar la venta",
                "estado" => "error"
            );

            echo json_encode($response);

        }


		
	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta()
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

			$respuesta = ModeloVenta::mdlEditarVenta($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		} else {

			echo json_encode("error");
		}
	}

	/*=============================================
	BORRAR VENTA
	=============================================*/

	static public function ctrBorrarVenta()
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



			$respuesta = ModeloVenta::mdlBorrarVenta($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}

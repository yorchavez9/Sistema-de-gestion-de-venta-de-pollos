<?php

class ControladorVenta
{


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
	MOSTRAR DETALLE VENTA
	=============================================*/

	static public function ctrMostrarDetalleVenta($item, $valor)
	{

		$tablaDV = "detalle_venta";
		$tablaP = "productos";

		$respuesta = ModeloVenta::mdlMostrarListaDetalleVenta($tablaDV, $tablaP, $item, $valor);

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
	ACTUALIZAR EL PAGO DE DEUDA EGRESO
	=============================================*/
	
	static public function ctrActualizarDeudaVenta(){

		$tabla = "ventas";

		$totalPago = number_format($_POST["monto_pagar_venta"], 2, '.', '');

		$datos = array(
			"id_venta" => $_POST["id_venta_pagar"],
			"total_pago" => $totalPago
		);

        $respuesta = ModeloVenta::mdlActualizarPagoPendiente($tabla, $datos);

        if ($respuesta == "ok") {

            echo json_encode($respuesta);

        } else {

            echo json_encode($respuesta);

        }

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta()
	{



		$tabla = "ventas";

		$pago_total = 0;

		if($_POST["tipo_pago"] == "contado"){

			$pago_total = $_POST["total"];

		}else{
			$pago_total = 0;
		}

		


		$datos = array(
			"id_venta" => $_POST["edit_id_venta"],
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

	

		$respuesta = ModeloVenta::mdlEditarVenta($tabla, $datos);


		/* ==========================================
		ACTUALIZANDO LOS DATOS DEL DETALLE PRODUCTO
		========================================== */

		$tblDetalleVenta = "detalle_venta";

		$productos = json_decode($_POST["productoAddVenta"], true);



		$datos = array();

		foreach ($productos as $dato) {
			$nuevo_dato = array(
				"id_venta" => $_POST["edit_id_venta"],
				'id_producto' => $dato['id_producto'],
				'precio_venta' => $dato['precio_venta'],
				'cantidad_u' => $dato['cantidad_u'],
				'cantidad_kg' => $dato['cantidad_kg']
			);

			$datos[] = $nuevo_dato;

			 $respuestaDatos = ModeloVenta::mdlEditarDetalleVenta($tblDetalleVenta, $nuevo_dato);

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
                "mensaje" => "La venta se actualizó con éxito",
                "estado" => "ok"
            );

            echo json_encode($response);

        } else {

            $response = array(
                "mensaje" => "Error al actualizar la venta",
                "estado" => "error"
            );

            echo json_encode($response);

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

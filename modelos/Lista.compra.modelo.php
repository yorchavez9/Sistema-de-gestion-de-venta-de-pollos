<?php

require_once "Conexion.php";

class ModeloListaCompra
{

	/*=============================================
	MOSTRAR EGRESOS
	=============================================*/

	static public function mdlMostrarEgreso($tablaD, $tablaE, $tablaP, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * from $tablaD as c inner join $tablaE as p on c.id_categoria = p.id_categoria WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaD as d INNER JOIN $tablaE as e on d.id_egreso = e.id_egreso INNER JOIN $tablaP as p ON p.id_persona = e.id_persona  ORDER BY e.id_egreso DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		}



		$stmt = null;
	}

	/*=============================================
	REGISTRO DE EGRESOS
	=============================================*/

	static public function mdlIngresarEgreso($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
                                                                id_categoria,
                                                                codigo_producto, 
                                                                nombre_producto, 
                                                                stock_producto, 
                                                                fecha_vencimiento, 
                                                                descripcion_producto, 
                                                                imagen_producto) 
                                                                VALUES (
                                                                :id_categoria, 
                                                                :codigo_producto, 
                                                                :nombre_producto, 
                                                                :stock_producto, 
                                                                :fecha_vencimiento, 
                                                                :descripcion_producto, 
                                                                :imagen_producto)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_producto", $datos["stock_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_producto", $datos["descripcion_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_producto", $datos["imagen_producto"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}

	/*=============================================
	EDITAR EGRESOS
	=============================================*/

	static public function mdlEditarEgreso($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																id_categoria = :id_categoria, 
																codigo_producto = :codigo_producto, 
																nombre_producto = :nombre_producto, 
																stock_producto = :stock_producto, 
																fecha_vencimiento = :fecha_vencimiento, 
																descripcion_producto = :descripcion_producto, 
																imagen_producto = :imagen_producto
																WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_producto", $datos["stock_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_producto", $datos["descripcion_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_producto", $datos["imagen_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR EGRESOS
	=============================================*/

	static public function mdlActualizarEgreso($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR EGRESOS
	=============================================*/

	static public function mdlActualizarPagoPendiente($tabla, $datos)
	{
		$respuesta = array();

		// Obtener el total actual de pagos para este egreso
		$stmt = Conexion::conectar()->prepare("SELECT total_pago FROM $tabla WHERE id_egreso = :id_egreso");
		$stmt->bindParam(":id_egreso", $datos["id_egreso"], PDO::PARAM_STR);
		$stmt->execute();
		$totalActual = $stmt->fetchColumn();

		// Calcular el nuevo total de pagos sumando el monto proporcionado
		$nuevoTotal = $totalActual + $datos["total_pago"];

		// Obtener el total de la compra
		$stmt = Conexion::conectar()->prepare("SELECT total_compra FROM $tabla WHERE id_egreso = :id_egreso");
		$stmt->bindParam(":id_egreso", $datos["id_egreso"], PDO::PARAM_STR);
		$stmt->execute();
		$totalCompra = $stmt->fetchColumn();

		// Verificar si el nuevo total de pagos supera el total de la compra
		if ($nuevoTotal > $totalCompra) {
			// Si supera el total de la compra, retornar error
			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = "El total de los pagos supera el total de la compra";
		} else {
			// Si no supera el total de la compra, proceder con la actualización
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET total_pago = :nuevo_total_pago WHERE id_egreso = :id_egreso");
			$stmt->bindParam(":nuevo_total_pago", $nuevoTotal, PDO::PARAM_STR);
			$stmt->bindParam(":id_egreso", $datos["id_egreso"], PDO::PARAM_STR);

			if ($stmt->execute()) {
				$respuesta["estado"] = "ok";
				$respuesta["mensaje"] = "El pago se actualizó correctamente";
			} else {
				$respuesta["estado"] = "error";
				$respuesta["mensaje"] = "No se pudo actualizar el total de pagos";
			}
		}

		return $respuesta;
	}



	/*=============================================
	BORRAR EGRESOS
	=============================================*/

	static public function mdlBorrarEgreso($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}
}
